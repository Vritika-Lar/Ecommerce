<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterSubscribed;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'newsletter_email' => ['required', 'email'],
        ]);

        $email = $data['newsletter_email'];

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $email],
            [
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]
        );

        if ($subscriber->wasRecentlyCreated) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterSubscribed($subscriber));
            } catch (\Throwable $e) {
                report($e);
            }

            return back()->with('newsletter_success', 'Thanks for subscribing. Please check your email.');
        }

        return back()->with('newsletter_success', 'You are already subscribed.');
    }
}
