<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $data = [
            'email' => $request->email,
            'subject' => 'New Newsletter Subscription',
        ];

        Mail::send('emails.newsletter', $data, function ($message) use ($data) {
            $message->to('info@kaukamedics.com')
                ->subject($data['subject'])
                ->replyTo($data['email']);
        });

        return back()->with('newsletter_success', 'Thanks for subscribing to our newsletter.');
    }

    public function send(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        // Prepare email data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messageContent' => $request->message,
        ];

        // Send email
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('info@kaukamedics.com')
                    ->subject('New Message: ' . $data['subject'])
                    ->replyTo($data['email'], $data['name']);
        });

        return back()->with('success', 'Thank you! Your message has been sent.');
    }
    
    
    
    //for mobile application
    
    public function sendapi(Request $request)
    {
        // Validate form inputs
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messageContent' => $request->message,
        ];

        try {
            // Send email
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->to('info@kaukamedics.com')
                        ->subject('New Message: ' . $data['subject'])
                        ->replyTo($data['email'], $data['name']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage(),
            ], 500);
        }
    }
}
