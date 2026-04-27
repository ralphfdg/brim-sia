<x-admin-layout>
    <x-slot name="header">Incident Details</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.incidents') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-700">&larr; Back to Audit Log</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-black text-slate-800">{{ $incident->incident_type }}</h2>
                        <p class="text-slate-500 mt-1">{{ \Carbon\Carbon::parse($incident->created_at)->format('l, F j, Y \a\t h:i A') }}</p>
                    </div>
                    <span class="px-3 py-1 bg-slate-100 text-slate-700 font-bold text-xs rounded-full uppercase">{{ $incident->status }}</span>
                </div>
                
                <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Location</h4>
                <p class="text-slate-800 font-medium mb-6">{{ $incident->location_details }}</p>

                <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Description</h4>
                <p class="text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $incident->description }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Reporter Info</h3>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold text-lg">
                        {{ substr($incident->resident->first_name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800">{{ $incident->resident->first_name ?? 'Unknown' }} {{ $incident->resident->last_name ?? 'Resident' }}</p>
                        <p class="text-sm text-slate-500">{{ $incident->resident->contact_number ?? 'No contact provided' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Audit Action</h3>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Change Status</label>
                <select id="statusSelect" class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm mb-4">
                    <option value="Pending" {{ $incident->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Acknowledged" {{ $incident->status == 'Acknowledged' ? 'selected' : '' }}>Acknowledged</option>
                    <option value="Logged" {{ $incident->status == 'Logged' ? 'selected' : '' }}>Logged</option>
                    <option value="Resolved" {{ $incident->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
                <button onclick="saveStatus()" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-xl transition-all shadow-sm">
                    Update Status
                </button>
            </div>
        </div>
    </div>

    <script>
        function saveStatus() {
            const newStatus = document.getElementById('statusSelect').value;
            fetch(`/admin/incidents/{{ $incident->id }}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            }).then(res => res.json()).then(data => {
                alert('Incident logged successfully.');
                window.location.reload();
            });
        }
    </script>
</x-admin-layout>