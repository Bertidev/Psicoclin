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

    public function __construct(public readonly array $data)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from:new Addres($this->data['fromEmail'],$this->data['fromName']),
            subject: this->data['assunto'],
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'mails.contact',
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
