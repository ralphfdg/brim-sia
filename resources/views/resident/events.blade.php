<x-app-layout>
    <div style="padding: 20px; max-width: 800px; margin: 0 auto;">
        <h2>🎉 Community Events</h2>
        <p>Register for upcoming barangay activities.</p>
        <hr style="margin: 15px 0;">

        <div style="display: grid; gap: 15px;">
            @forelse($events as $event)
                <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; background: white;">
                    <h3 style="margin-top: 0; color: blue;">{{ $event->event_name }}</h3>
                    <p><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y, g:i a') }}</p>
                    <p><strong>📍 Location:</strong> {{ $event->location ?? 'TBA' }}</p>
                    <p><strong>🎟️ Fee:</strong> {{ $event->registration_fee > 0 ? '₱' . number_format($event->registration_fee, 2) : 'FREE' }}</p>
                    
                    <button onclick="registerForEvent('{{ $event->id }}')" style="background: {{ $event->registration_fee > 0 ? 'blue' : 'green' }}; color: white; padding: 8px 15px; border: none; cursor: pointer; border-radius: 4px; font-weight: bold; margin-top: 10px;">
                        {{ $event->registration_fee > 0 ? 'Pay & Register' : 'Register for Free' }}
                    </button>
                </div>
            @empty
                <p>No upcoming events at this time. Check back later!</p>
            @endforelse
        </div>

        <p id="event-status-msg" style="margin-top: 20px; font-weight: bold;"></p>
    </div>

    <script>
        function registerForEvent(eventId) {
            const msg = document.getElementById('event-status-msg');
            msg.innerText = "⏳ Processing registration...";
            msg.style.color = "orange";

            axios.post('/event-registrations', { event_id: eventId })
            .then(res => {
                if (res.data.payment_link) {
                    msg.innerText = "✅ Success! Redirecting to secure payment...";
                    msg.style.color = "green";
                    window.location.href = res.data.payment_link;
                } else {
                    msg.innerText = "✅ Successfully registered for the free event! An email has been sent.";
                    msg.style.color = "green";
                }
            })
            .catch(err => {
                msg.innerText = "❌ " + (err.response?.data?.error || "Could not register.");
                msg.style.color = "red";
                console.error(err);
            });
        }
    </script>
</x-app-layout> 