<x-app-layout>
    <div style="padding: 20px; max-width: 1000px; margin: 0 auto;">
        <h2>📄 Paid Certificate Requests</h2>
        <p>These residents have paid. Click "Approve" to generate their PDF document.</p>
        <hr style="margin: 15px 0;">
        
        <table style="width: 100%; text-align: left; border-collapse: collapse; margin-top: 15px; background: white;">
            <tr style="background: #fee2e2; border-bottom: 2px solid red;">
                <th style="padding: 12px;">Tracking #</th>
                <th>Resident Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>

            @forelse($certificates as $cert)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; font-weight: bold;">{{ $cert->tracking_number }}</td>
                    <td>{{ $cert->resident->first_name }} {{ $cert->resident->last_name }}</td>
                    <td>{{ $cert->certificate_type }}</td>
                    <td>
                        <button onclick="approveCertificate('{{ $cert->id }}')" style="background: green; color: white; padding: 8px 12px; border: none; cursor: pointer; border-radius: 4px;">
                            Approve & Generate PDF
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: gray;">No pending paid requests at this time.</td>
                </tr>
            @endforelse
        </table>

        <p id="admin-status-msg" style="margin-top: 20px; font-weight: bold;"></p>
    </div>

    <script>
        function approveCertificate(certificateId) {
            const msg = document.getElementById('admin-status-msg');
            msg.innerText = "⏳ Triggering Make.com automation...";
            msg.style.color = "orange";

            // Call the PUT route we set up in web.php
            axios.put(`/admin/certificates/${certificateId}`, {
                request_status: 'Ready'
            })
            .then(res => {
                msg.innerText = "✅ Success! Document is being generated. Refreshing table...";
                msg.style.color = "green";
                setTimeout(() => window.location.reload(), 1500);
            })
            .catch(err => {
                msg.innerText = "❌ Error: Could not process approval.";
                msg.style.color = "red";
                console.error(err);
            });
        }
    </script>
</x-app-layout>