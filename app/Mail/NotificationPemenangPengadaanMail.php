<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class NotificationPemenangPengadaanMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $param;

    /**
     * Create a new message instance.
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'NOTIFIKASI PEMENANG PENGADAAN',
            from: new Address('no-reply@andaka.com', 'VENDOR MANAGEMENT SYSTEM'),  // Correct usage
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'backend.email-pemenang',
            with: [
                'param' => $this->param,
            ]
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
