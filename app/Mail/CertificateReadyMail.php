<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateReadyMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $certificateRequest;

    public function __construct($certificateRequest)
    {
        $this->certificateRequest = $certificateRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your Barangay Certificate is Ready!');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.certificate_ready');
    }
}   