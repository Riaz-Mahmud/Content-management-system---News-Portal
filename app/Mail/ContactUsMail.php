<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $message;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->message = $data['message'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $name = $this->data['name'];
        $email = $this->data['email'];
        $subject = $name . ' sent you a message';
        return new Envelope(
            subject: $subject,
            from: env('MAIL_FROM_ADDRESS'),
            to: $email,
            replyTo: $email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.email.contactus',
            with: ['data' => $this->message, 'name' => $this->data['name'], 'email' => $this->data['email']],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
