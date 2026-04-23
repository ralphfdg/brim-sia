<!DOCTYPE html>
<html>
<head>
    <title>Welcome to B.R.I.M.</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Hello, {{ $resident->first_name }} {{ $resident->last_name }}!</h2>
    
    <p>Your resident profile has been successfully registered in the Barangay Resident Information and Management (B.R.I.M.) system.</p>
    
    <p><strong>Your Details:</strong></p>
    <ul>
        <li>Address: {{ $resident->purok_or_street }}</li>
        <li>Contact: {{ $resident->contact_number }}</li>
    </ul>

    <p>If you need to request a Barangay Clearance or ID, you can now do so through our automated system.</p>

    <p>Best Regards,<br>Barangay Administration</p>
</body>
</html>