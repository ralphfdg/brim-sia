<x-app-layout>
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2>🎉 Create Barangay Event</h2>
        <p>Publish an upcoming event or activity for the residents.</p>
        <hr style="margin: 15px 0;">

        <form id="create-event-form">
            <label>Event Name:</label><br>
            <input type="text" id="event_name" required style="width: 100%; margin-bottom: 10px;" placeholder="e.g. Summer Basketball Liga"><br>

            <label>Event Date & Time:</label><br>
            <input type="datetime-local" id="event_date" required style="width: 100%; margin-bottom: 10px;"><br>

            <label>Location:</label><br>
            <input type="text" id="location" style="width: 100%; margin-bottom: 10px;" placeholder="e.g. Barangay Court"><br>
            
            <label>Max Attendees (Leave blank for unlimited):</label><br>
            <input type="number" id="max_attendees" style="width: 100%; margin-bottom: 10px;" min="1"><br>

            <label>Registration Fee (₱):</label><br>
            <input type="number" id="registration_fee" required style="width: 100%; margin-bottom: 10px;" step="0.01" value="0.00" min="0"><br>

            <button type="submit" style="background: green; color: white; padding: 12px; width: 100%; border: none; font-weight: bold; cursor: pointer;">
                Publish Event
            </button>
        </form>
        <p id="event-msg" style="margin-top: 15px; font-weight: bold;"></p>
    </div>

    <script>
        document.getElementById('create-event-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = document.getElementById('event-msg');
            msg.innerText = "⏳ Publishing...";
            
            axios.post('/admin/events', {
                event_name: document.getElementById('event_name').value,
                event_date: document.getElementById('event_date').value,
                location: document.getElementById('location').value,
                max_attendees: document.getElementById('max_attendees').value || null,
                registration_fee: document.getElementById('registration_fee').value,
            })
            .then(res => {
                msg.innerText = "✅ Success! Event Published.";
                msg.style.color = "green";
                document.getElementById('create-event-form').reset();
            })
            .catch(err => {
                msg.innerText = "❌ Failed to publish event.";
                msg.style.color = "red";
                console.error(err);
            });
        });
    </script>
</x-app-layout>