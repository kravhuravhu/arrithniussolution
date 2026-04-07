<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|min:10',
            'consent' => 'accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $formData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company ?? 'Not provided',
                'subject' => $request->subject,
                'userMessage' => $request->message,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'submitted_at' => now()->format('Y-m-d H:i:s')
            ];

            Mail::send('emails.contact-notification', $formData, function ($message) use ($formData) {
                $message->to(env('COMPANY_EMAIL', 'info@arrithnius.co.za'))
                        ->subject('New Contact Form Submission: ' . $formData['subject'])
                        ->replyTo($formData['email'], $formData['name']);
            });

            Mail::send('emails.contact-auto-reply', $formData, function ($message) use ($formData) {
                $message->to($formData['email'], $formData['name'])
                        ->subject('Thank you for contacting Arrithnius Solution');
            });

            Log::info('Contact form submitted', [
                'name' => $formData['name'],
                'email' => $formData['email'],
                'ip' => $formData['ip']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will get back to you within 24 hours.'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending your message. Please try again later or contact us directly via phone/WhatsApp.'
            ], 500);
        }
    }

    /**
     * Handle quote request form submission
     */
    public function requestQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'budget' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'message' => 'required|string|min:20',
            'has_branding' => 'nullable|string',
            'has_hosting' => 'nullable|string',
            'consent' => 'accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $formData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'service' => $request->service,
                'budget' => $request->budget ?? 'Not specified',
                'timeline' => $request->timeline ?? 'Not specified',
                'userMessage' => $request->message,
                'has_branding' => $request->has_branding ?? 'Not specified',
                'has_hosting' => $request->has_hosting ?? 'Not specified',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'submitted_at' => now()->format('Y-m-d H:i:s')
            ];

            // Send email to company
            Mail::send('emails.quote-notification', $formData, function ($message) use ($formData) {
                $message->to(env('COMPANY_EMAIL', 'info@arrithnius.co.za'))
                        ->subject('New Quote Request from ' . $formData['company'])
                        ->replyTo($formData['email'], $formData['name']);
            });

            // Send auto-reply to customer
            Mail::send('emails.quote-auto-reply', $formData, function ($message) use ($formData) {
                $message->to($formData['email'], $formData['name'])
                        ->subject('Your Quote Request - Arrithnius Solution');
            });

            Log::info('Quote request submitted', [
                'name' => $formData['name'],
                'company' => $formData['company'],
                'service' => $formData['service']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your quote request has been received! We will prepare a custom quote and get back to you within 24 hours.'
            ]);

        } catch (\Exception $e) {
            Log::error('Quote request error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your quote request. Please try again later or contact us directly.'
            ], 500);
        }
    }
}