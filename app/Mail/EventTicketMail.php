<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\Resident;

class EventTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $resident;

    public function __construct(Event $event, Resident $resident)
    {
        // Pass the database models into the email
        $this->event = $event;
        $this->resident = $resident;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Event Registration Ticket - B.R.I.M.',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.event_ticket', // This points to the HTML file we will make next
        );
    }
}