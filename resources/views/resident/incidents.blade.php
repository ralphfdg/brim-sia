<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report an Incident') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4">Submit a New Report</h3>
                
                <div id="success-alert" class="hidden mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    Incident successfully sent to the API. The Tanod has been alerted via SMS!
                </div>

                <form id="incident-form" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Incident Type</label>
                        <select id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Noise Complaint">Noise Complaint</option>
                            <option value="Broken Infrastructure">Broken Infrastructure</option>
                            <option value="Suspicious Activity">Suspicious Activity</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location Details</label>
                        <input type="text" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. Purok 4, near the covered court" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        Submit Report to API
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('incident-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Stop standard HTML form submission
            
            // Gather the data from the inputs
            const payload = {
                incident_type: document.getElementById('type').value,
                location_details: document.getElementById('location').value,
                description: document.getElementById('description').value
            };

            // Call your secure API endpoint
            axios.post('/api/incidents', payload)
                .then(response => {
                    // Show success message and clear form
                    document.getElementById('success-alert').classList.remove('hidden');
                    document.getElementById('incident-form').reset();
                    console.log('API Response:', response.data);
                })
                .catch(error => {
                    alert('Error submitting to API. Check console.');
                    console.error(error.response.data);
                });
        });
    </script>
</x-app-layout>