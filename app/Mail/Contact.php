<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $messageContent;

    public function __construct($email ,$subject, $message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->messageContent = $message;
    }

    public function build()
    {
        $email = $this->from(config('mail.from.address'), config('mail.from.name'))
        ->subject($this->subject)
        ->view('emails.contact')
        ->with([
            'email' => $this->email,
            'subject' => $this->subject,
            'messageContent' => $this->messageContent,
        ]);
        
        return $email;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.contact.contact',
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
