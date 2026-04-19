<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VcardContact;

class VcardContactController extends Controller
{
    public function uploadVcard(Request $request)
    {
        $request->validate([
            'vcard_file' => 'required|mimes:vcf,txt'
        ]);

        $file = $request->file('vcard_file');
        $content = file_get_contents($file->getRealPath());

        $blocks = preg_split('/END:VCARD/i', $content);

        foreach ($blocks as $block) {
            if (trim($block) === '') continue;

            $fullName = $this->extractVcardField($block, 'FN');
            $phone    = $this->extractVcardField($block, 'TEL');
            $email    = $this->extractVcardField($block, 'EMAIL');
            $address  = $this->extractVcardField($block, 'ADR');
            $org      = $this->extractVcardField($block, 'ORG');
            $title    = $this->extractVcardField($block, 'TITLE');

            VcardContact::create([
                'full_name'     => $fullName,
                'phone_number'  => $phone,
                'email'         => $email,
                'address'       => $address,
                'organization'  => $org,
                'job_title'     => $title,
            ]);
        }

        return back()->with('success', 'vCard contacts imported successfully!');
    }

    private function extractVcardField($block, $field)
    {
        $pattern = '/' . $field . '.*?:([^\\n]+)/i';

        if (preg_match($pattern, $block, $match)) {
            return trim(str_replace(';', ' ', $match[1]));
        }

        return null;
    }
    
    public function index()
{
    // Retrieve all uploaded vCards, newest first
    $contacts = VcardContact::orderBy('id', 'desc')->get();

    return view('bulk', compact('contacts'));
}


}
