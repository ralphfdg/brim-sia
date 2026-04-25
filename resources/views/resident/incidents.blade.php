<x-app-layout>
    <div style="padding: 20px; max-width: 500px;">
        <h2>🚨 Report an Incident</h2>
        <hr>
        
        <form id="incident-form" style="margin-top: 15px;">
            <label>Incident Type:</label><br>
            <select id="incident_type" required style="width: 100%; margin-bottom: 10px;">
                <option value="Crime/Suspicious Activity">Crime/Suspicious Activity</option>
                <option value="Fire Emergency">Fire Emergency</option>
                <option value="Noise Complaint">Noise Complaint</option>
                <option value="Infrastructure Issue">Infrastructure Issue</option>
            </select><br>

            <label>Specific Location (e.g. Purok 4, House #12):</label><br>
            <input type="text" id="location_details" required style="width: 100%; margin-bottom: 10px;"><br>

            <label>Detailed Description:</label><br>
            <textarea id="description" required style="width: 100%; margin-bottom: 10px;" rows="4"></textarea><br>

            <button type="submit" style="background: red; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                Submit to Barangay Tanod
            </button>
        </form>

        <p id="response-msg" style="margin-top: 10px; font-weight: bold; color: green;"></p>
    </div>

    <script>
        document.getElementById('incident-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = document.getElementById('response-msg');
            msg.innerText = "Processing report...";

            const data = {
                incident_type: document.getElementById('incident_type').value,
                location_details: document.getElementById('location_details').value,
                description: document.getElementById('description').value
            };

            // Secure API call to our backend
            axios.post('/incidents', data)
                .then(res => {
                    msg.innerText = "✅ Success! Incident logged and SMS dispatched.";
                    document.getElementById('incident-form').reset();
                })
                .catch(err => {
                    msg.innerText = "❌ Error: Could not send report.";
                    console.error(err);
                });
        });
    </script>
</x-app-layout>