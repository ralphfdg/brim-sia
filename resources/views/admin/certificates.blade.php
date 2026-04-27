<x-admin-layout>
    <x-slot name="header">
        Certificate Processing Queue
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">Pending Paid Requests</h3>
            <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Action Required</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-bold text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Tracking #</th>
                        <th class="px-6 py-4">Resident Name</th>
                        <th class="px-6 py-4">Document Type</th>
                        <th class="px-6 py-4">Date Paid</th>
                        <th class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($certificates as $cert)
                        <tr class="hover:bg-slate-50/50 transition-colors" id="row-{{ $cert->id }}">
                            <td class="px-6 py-4 font-mono text-slate-900 font-medium">{{ $cert->tracking_number }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $cert->resident->first_name }} {{ $cert->resident->last_name }}</td>
                            <td class="px-6 py-4">{{ $cert->certificate_type }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cert->updated_at)->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4">
                                <button onclick="markAsReady('{{ $cert->id }}')" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition shadow-sm text-xs">
                                    Mark as Ready
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-lg font-medium text-slate-600">No pending requests.</p>
                                <p class="text-sm mt-1">All paid certificates have been processed.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function markAsReady(id) {
            if(!confirm('Are you sure the physical document is printed and ready for pickup? This will send an SMS to the resident.')) return;
            
            fetch(`/admin/certificates/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ request_status: 'Ready' })
            })
            .then(response => response.json())
            .then(data => {
                if(data.message) {
                    alert('Success! Resident has been notified.');
                    // Remove the row from the table smoothly
                    document.getElementById(`row-${id}`).style.display = 'none';
                } else {
                    alert('Error updating status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('A server error occurred.');
            });
        }
    </script>
</x-admin-layout>   