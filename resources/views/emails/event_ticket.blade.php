<div style="font-family: sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h2 style="color: purple;">Event Registration Confirmed! 🎟️</h2>
    <p>Hello <strong>{{ $resident->first_name }}</strong>,</p>
    <p>You are officially registered for the upcoming barangay event:</p>
    
    <div style="background: #f3f4f6; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <h3 style="margin: 0 0 10px 0;">{{ $event->event_name }}</h3>
        <p style="margin: 5px 0;"><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y, g:i a') }}</p>
        <p style="margin: 5px 0;"><strong>📍 Location:</strong> {{ $event->location ?? 'TBA' }}</p>
    </div>

    <p>Please present this email or your ID at the venue entrance.</p>
    <br>
    <p>See you there,<br><strong>Barangay Administration</strong></p>
</div>