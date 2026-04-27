<x-resident-layout>
    <x-slot name="header">
        Incident Reports
    </x-slot>

    <div class="space-y-6">
        
        <!-- Report New Incident Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-bl-full -z-10"></div>
            
            <div class="bg-slate-50/50 backdrop-blur-sm px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Report an Incident
                </h3>
            </div>
            
            <div class="p-6">
                <form id="incident-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Incident Type</label>
                            <select id="incident_type" required class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2">
                                <option value="Crime/Suspicious Activity">Crime/Suspicious Activity</option>
                                <option value="Fire Emergency">Fire Emergency</option>
                                <option value="Noise Complaint">Noise Complaint</option>
                                <option value="Infrastructure Issue">Infrastructure Issue</option>
                                <option value="Medical Emergency">Medical Emergency</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Specific Location</label>
                            <input type="text" id="location_details" required class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2" placeholder="e.g. Purok 4, House #12">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Detailed Description</label>
                        <textarea id="description" required rows="3" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2" placeholder="Please describe what happened..."></textarea>
                    </div>
                    
                    <div class="flex items-center justify-between pt-2">
                        <p id="response-msg" class="text-sm font-medium"></p>
                        <button type="submit" id="submit-btn" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span>Submit Alert</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- History Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <h3 class="text-lg font-bold text-slate-800">My Incident Reports</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 tracking-wider">Date & Time</th>
                            <th class="px-6 py-3 tracking-wider">Incident Type</th>
                            <th class="px-6 py-3 tracking-wider">Location</th>
                            <th class="px-6 py-3 tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($incidents as $incident)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">
                                    {{ $incident->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full @if($incident->incident_type == 'Fire Emergency' || $incident->incident_type == 'Crime/Suspicious Activity') bg-red-500 @else bg-orange-400 @endif"></div>
                                        {{ $incident->incident_type }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Str::limit($incident->location_details, 20) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($incident->status === 'Pending')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending Review</span>
                                    @elseif($incident->status === 'Dispatched')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">Dispatched</span>
                                    @elseif($incident->status === 'Resolved')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-400/20 text-emerald-700">Resolved</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">{{ $incident->status ?? 'Reported' }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('resident.incidents.show', $incident->id) }}" class="text-emerald-600 hover:text-emerald-800 font-medium text-sm transition-colors">View Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        <p>You haven't reported any incidents.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-100">
                {{ $incidents->links() }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('incident-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = document.getElementById('response-msg');
            const btn = document.getElementById('submit-btn');

            msg.innerText = "⏳ Processing report...";
            msg.className = "text-sm font-medium text-amber-600";
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            const data = {
                incident_type: document.getElementById('incident_type').value,
                location_details: document.getElementById('location_details').value,
                description: document.getElementById('description').value
            };

            axios.post('{{ route('resident.incidents') }}', data)
                .then(res => {
                    msg.innerText = "✅ Success! Incident logged and authorities alerted.";
                    msg.className = "text-sm font-medium text-green-600";
                    document.getElementById('incident-form').reset();
                    setTimeout(() => { window.location.reload(); }, 1500);
                })
                .catch(err => {
                    msg.innerText = "❌ Error: Could not send report.";
                    msg.className = "text-sm font-medium text-red-600";
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');
                });
        });
    </script>
</x-resident-layout>