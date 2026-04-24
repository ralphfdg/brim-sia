<!DOCTYPE html>
<html>
<head>
    <title>Event Ticket</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Hello, {{ $resident->first_name }}!</h2>
    
    <p>You have successfully registered for the upcoming barangay event:</p>
    
    <div style="background-color: #f4f4f4; padding: 15px; border-radius: 5px;">
        <h3 style="margin-top: 0;">{{ $event->event_name }}</h3>
        <p><strong>Date:</strong> {{ $event->event_date }}</p>
        <p><strong>Status:</strong> 
            @if($event->registration_fee > 0)
                <span style="color: red;">Unpaid - Please proceed to the barangay hall to pay your fee of P{{ $event->registration_fee }}.</span>
            @else
                <span style="color: green;">Free Event - You are fully registered!</span>
            @endif
        </p>
    </div>

    <p>Thank you for participating in our community!<br>
    <strong>Barangay B.R.I.M. Administration</strong></p>
</body>
</html>