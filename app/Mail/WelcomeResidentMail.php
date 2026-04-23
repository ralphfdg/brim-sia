<?php

namespace App\Mail;

use App\Models\Resident;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeResidentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resident;

    /**
     * Create a new message instance.
     */
    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
    }

    /**
     * Get the message envelope (Subject line).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to BRIM, ' . $this->resident->first_name . '!' . 'Barangay services at your fingertips.',
        );
    }

    /**
     * Get the message content definition (The HTML template).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome_resident',
        );
    }
}