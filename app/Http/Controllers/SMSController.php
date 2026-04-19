<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SentSms;
use App\Models\VcardContact;
use Maatwebsite\Excel\Facades\Excel;

class SMSController extends Controller
{
    public function sendBulk(Request $request)
    {
        // Add this at the beginning of sendBulk method:
        if ($request->has('send_mode')) {
            $mode = $request->send_mode;
        } elseif ($request->has('send_to_imported')) {
            // For backward compatibility
            $mode = $request->send_to_imported ? 'imported_all' : 'manual';
        } else {
            $mode = 'manual';
        }
        $request->validate([
            'sender_id' => 'required|max:11',
            'message'   => 'required|string',
            'send_mode' => 'required|in:manual,imported_all,select_contacts',
            'full_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:50',
            'selected_contacts' => 'array|nullable',
            'selected_phone_numbers' => 'string|nullable',
        ]);

        $recipients = [];
        $i = 1;

        switch ($request->send_mode) {
            case 'manual':
                // Send to manually typed contact
                if (!$request->phone_number) {
                    return back()->with('error', 'Please enter a phone number.');
                }
                
                $phone = $this->normalizePhoneNumber($request->phone_number);
                if ($phone) {
                    $recipients[] = [
                        "recipient_id" => $i++,
                        "dest_addr" => $phone
                    ];
                }
                break;

            case 'imported_all':
                // Send to all imported contacts
                $contacts = VcardContact::all();
                foreach ($contacts as $contact) {
                    if ($contact->phone_number) {
                        $recipients[] = [
                            "recipient_id" => $i++,
                            "dest_addr" => $contact->phone_number
                        ];
                    }
                }
                break;

            case 'select_contacts':
                // Send to selected contacts
                if ($request->filled('selected_phone_numbers')) {
                    // Get phone numbers from the hidden field
                    $phoneNumbers = explode(',', $request->selected_phone_numbers);
                    foreach ($phoneNumbers as $phone) {
                        if ($phone = $this->normalizePhoneNumber($phone)) {
                            $recipients[] = [
                                "recipient_id" => $i++,
                                "dest_addr" => $phone
                            ];
                        }
                    }
                } elseif ($request->has('selected_contacts')) {
                    // Get phone numbers from selected contact IDs
                    $contactIds = $request->selected_contacts;
                    $contacts = VcardContact::whereIn('id', $contactIds)->get();
                    foreach ($contacts as $contact) {
                        if ($contact->phone_number) {
                            $recipients[] = [
                                "recipient_id" => $i++,
                                "dest_addr" => $contact->phone_number
                            ];
                        }
                    }
                } else {
                    return back()->with('error', 'Please select at least one contact.');
                }
                break;
        }

        if (empty($recipients)) {
            return back()->with('error', 'No valid phone numbers to send SMS.');
        }

        // Prepare payload
        $payload = [
            "source_addr" => $request->sender_id,
            "encoding" => "0",
            "message" => $request->message,
            "recipients" => $recipients
        ];

        $apiKey = env('BEEM_API_KEY');
        $secretKey = env('BEEM_SECRET_KEY');

        $response = Http::withBasicAuth($apiKey, $secretKey)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://apisms.beem.africa/v1/send', $payload);

        if ($response->successful()) {
            foreach ($recipients as $r) {
                SentSms::create([
                    'receiver' => $r['dest_addr'],
                    'message'  => $request->message,
                    'status'   => 'successfully',
                ]);
            }
            return back()->with('success', 'Bulk SMS sent successfully to ' . count($recipients) . ' contacts!');
        }

        return back()->with('error', 'Failed to send: ' . $response->body());
    }

    /**
     * Normalize phone number
     */
    private function normalizePhoneNumber($phone)
    {
        if (!$phone) return null;

        // Convert to string
        $phone = trim((string) $phone);

        // Remove spaces, symbols (+, -, etc.)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Excel removes leading zero → Fix if length = 9
        if (strlen($phone) === 9 && $phone[0] !== '0') {
            $phone = "0" . $phone;
        }

        // Convert 0xxxxxxxxx → 255xxxxxxxxx
        if (preg_match('/^0\d{9}$/', $phone)) {
            $phone = "255" . substr($phone, 1);
        }

        // Return only if it's a valid Tanzanian number format
        if (preg_match('/^255\d{9}$/', $phone)) {
            return $phone;
        }

        return null;
    }

public function index()
{
    $messages = SentSms::orderBy('id', 'desc')
        ->paginate(30, ['*'], 'messages_page');

    $contacts = VcardContact::orderBy('id', 'asc')
        ->get(); // no second parameter
    $total = VcardContact::orderBy('id','desc')
        ->count();

    return view('bulk', compact('messages', 'contacts','total'));
}


    public function uploadVcard(Request $request)
    {
        // -----------------------
        // 1. FILE UPLOAD (CSV / XLSX)
        // -----------------------
        if ($request->hasFile('vcard_file')) {

            $request->validate([
                'vcard_file' => 'required|mimes:csv,xlsx'
            ]);

            $file = $request->file('vcard_file');
            $extension = $file->getClientOriginalExtension();

            $data = [];

            if ($extension === 'csv') {
                $data = array_map('str_getcsv', file($file->getRealPath()));
            } elseif ($extension === 'xlsx') {
                $data = Excel::toArray(null, $file)[0]; // first sheet
            }

            if (count($data) < 2) {
                return back()->with('error', 'The file is empty or invalid.');
            }

            // Normalize headers
            $headers = array_map(fn($h) => strtolower(trim($h)), $data[0]);

            $importedCount = 0;
            $skippedCount = 0;

            for ($i = 1; $i < count($data); $i++) {

                if (count(array_filter($data[$i])) === 0) continue;

                $row = $data[$i];

                if (count($row) < count($headers)) {
                    $row = array_pad($row, count($headers), null);
                } elseif (count($row) > count($headers)) {
                    $row = array_slice($row, 0, count($headers));
                }

                $rowAssoc = array_combine($headers, $row);

                // ---------------------------
                // PHONE NORMALIZATION LOGIC (CSV + EXCEL SAFE)
                // ---------------------------
                $phone = $rowAssoc['mobile phone'] ?? ($rowAssoc['primary phone'] ?? null);

                if ($phone !== null) {
                    $phone = $this->normalizePhoneNumber($phone);
                }

                $email = $rowAssoc['e-mail address'] ?? null;

                // Skip duplicates
                if ($phone && VcardContact::where('phone_number', $phone)->exists()) {
                    $skippedCount++;
                    continue;
                }

                if ($email && VcardContact::where('email', $email)->exists()) {
                    $skippedCount++;
                    continue;
                }

                VcardContact::create([
                    'full_name'     => $rowAssoc['first name'] ?? null,
                    'phone_number'  => $phone,
                    'email'         => $email,
                    'address'       => $rowAssoc['home address'] ?? null,
                    'organization'  => $rowAssoc['company'] ?? null,
                    'job_title'     => $rowAssoc['job title'] ?? null,
                ]);

                $importedCount++;
            }

            return back()->with('success', "$importedCount contacts imported, $skippedCount duplicates skipped.");
        }

        // -----------------------
        // 2. SINGLE CONTACT SUBMISSION
        // -----------------------
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'email'        => 'nullable|email|unique:vcard_contacts,email',
            'organization' => 'nullable|string|max:255',
            'address'      => 'nullable|string|max:500',
            'job_title'    => 'nullable|string|max:255',
        ]);

        $phone = $this->normalizePhoneNumber($request->phone_number);

        if (!$phone) {
            return back()->with('error', 'Invalid phone number format.');
        }

        // Check duplicate after normalization
        if (VcardContact::where('phone_number', $phone)->exists()) {
            return back()->with('error', 'Phone number already exists.');
        }

        VcardContact::create([
            'full_name'     => $request->full_name,
            'phone_number'  => $phone,
            'email'         => $request->email,
            'address'       => $request->address,
            'organization'  => $request->organization,
            'job_title'     => $request->job_title,
        ]);

        return back()->with('success', 'Contact added successfully.');
    }
    

}