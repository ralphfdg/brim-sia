<x-admin-layout>
    <x-slot name="header">Incident Audit Log</x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-900 text-xs uppercase font-bold text-slate-300 tracking-wider">
                <tr>
                    <th class="px-6 py-4">Date/Time Reported</th>
                    <th class="px-6 py-4">Incident Type</th>
                    <th class="px-6 py-4">Location</th>
                    <th class="px-6 py-4">Reporter</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Log Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-mono">
                @foreach($incidents as $inc)
                <tr class="hover:bg-slate-50 transition cursor-pointer" onclick="window.location='{{ route('admin.incidents.show', $inc->id) }}'">
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($inc->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $inc->incident_type }}</td>
                    <td class="px-6 py-4">{{ Str::limit($inc->location_details, 30) }}</td>
                    <td class="px-6 py-4">{{ $inc->resident->first_name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4">
                        <select onclick="event.stopPropagation()" onchange="updateStatus('{{ $inc->id }}', this.value)" class="text-xs font-bold rounded border-slate-300 py-1 pl-2 pr-6 shadow-sm focus:ring-emerald-500">
                            <option value="Pending" {{ $inc->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Under Investigation" {{ $inc->status == 'Under Investigation' ? 'selected' : '' }}>Under Investigation</option>
                            <option value="Resolved" {{ $inc->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 text-right text-emerald-600 font-bold">&rarr;</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4 bg-slate-50 border-t border-slate-100">{{ $incidents->links() }}</div>
    </div>

    <script>
        function updateStatus(id, newStatus) {
            fetch(`/admin/incidents/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: newStatus })
            }).then(res => res.json()).then(data => alert('Status updated in audit log.'));
        }
    </script>
</x-admin-layout>