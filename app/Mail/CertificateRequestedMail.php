<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateRequestedMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $certificateRequest;

    public function __construct($certificateRequest)
    {
        $this->certificateRequest = $certificateRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Certificate Request Received');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.certificate_requested');
    }
}