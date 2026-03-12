<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public NewsletterSubscriber $subscriber)
    {
    }

    public function build(): self
    {
        return $this->subject('Thanks for subscribing')
            ->view('emails.newsletter-subscribed');
    }
}
