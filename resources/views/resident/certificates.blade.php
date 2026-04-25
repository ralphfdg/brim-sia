<x-app-layout>
    <div style="padding: 20px; max-width: 600px; margin: 0 auto;">
        <h2>📄 Request a Barangay Certificate</h2>
        <p>Fill out the form below. You will be redirected to our secure payment gateway (Stripe) to pay the ₱50.00 processing fee.</p>
        <hr style="margin: 15px 0;">

        <form id="certificate-form">
            <label>Certificate Type:</label><br>
            <select id="certificate_type" required style="width: 100%; margin-bottom: 15px; padding: 8px;">
                <option value="Barangay Clearance">Barangay Clearance</option>
                <option value="Certificate of Indigency">Certificate of Indigency</option>
                <option value="Certificate of Residency">Certificate of Residency</option>
                <option value="Business Clearance">Business Clearance</option>
            </select><br>

            <label>Purpose of Request:</label><br>
            <input type="text" id="purpose" required style="width: 100%; margin-bottom: 15px; padding: 8px;" placeholder="e.g., Employment, Bank Requirements, School"><br>

            <button type="submit" id="submit-btn" style="background: blue; color: white; padding: 12px 20px; border: none; cursor: pointer; width: 100%; font-weight: bold;">
                Pay & Submit Request
            </button>
        </form>

        <p id="status-msg" style="margin-top: 15px; font-weight: bold; text-align: center;"></p>
    </div>

    <script>
        document.getElementById('certificate-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const msg = document.getElementById('status-msg');
            const btn = document.getElementById('submit-btn');

            msg.innerText = "⏳ Generating secure payment link...";
            msg.style.color = "orange";
            btn.disabled = true; // Prevent double-clicking

            const data = {
                certificate_type: document.getElementById('certificate_type').value,
                purpose: document.getElementById('purpose').value
            };

            // Send to our web route
            axios.post('/certificates', data)
                .then(res => {
                    msg.innerText = "✅ Success! Redirecting to Stripe...";
                    msg.style.color = "green";
                    
                    // The Magic: Redirect the user's browser to the Stripe URL
                    window.location.href = res.data.payment_link;
                })
                .catch(err => {
                    msg.innerText = "❌ Error: Could not process request. Check console.";
                    msg.style.color = "red";
                    btn.disabled = false;
                    console.error(err);
                });
        });
    </script>
</x-app-layout>