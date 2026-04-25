<div style="font-family: sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h2 style="color: blue;">Certificate Request Received</h2>
    <p>Hello,</p>
    <p>We have successfully received your request for a <strong>{{ $certificateRequest->certificate_type }}</strong>.</p>
    <p><strong>Tracking Number:</strong> {{ $certificateRequest->tracking_number }}</p>
    <p><strong>Status:</strong> Processing</p>
    <p>We will notify you via email and SMS as soon as your document is ready for pickup or download.</p>
    <br>
    <p>Thank you,<br><strong>Barangay Administration</strong></p>
</div>