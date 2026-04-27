<x-admin-layout>
    <x-slot name="header">Command Center</x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pending Docs</h3>
            <p class="text-4xl font-black text-slate-800 mt-2">{{ $stats['pending_certs'] ?? 0 }}</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Ready for Pickup</h3>
            <p class="text-4xl font-black text-emerald-600 mt-2">{{ $stats['ready_certs'] ?? 0 }}</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md transition">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Active Alerts</h3>
            <p class="text-4xl font-black text-red-500 mt-2">{{ $stats['active_incidents'] ?? 0 }}</p>
        </div>
        
        <div class="bg-[#0f172a] rounded-2xl p-6 shadow-lg border border-slate-800 flex flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white opacity-5 rounded-full blur-2xl"></div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest relative z-10">Upcoming Events</h3>
            <p class="text-4xl font-black mt-2 relative z-10">{{ $stats['upcoming_events'] ?? 0 }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-3 gap-4">
                    <a href="{{ route('admin.certificates') }}" class="flex flex-col items-center justify-center p-4 bg-emerald-50 text-emerald-700 rounded-xl hover:bg-emerald-100 transition font-semibold text-sm border border-emerald-100">
                        <span class="text-2xl mb-1">📄</span> Process Docs
                    </a>
                    <a href="{{ route('admin.incidents') }}" class="flex flex-col items-center justify-center p-4 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 transition font-semibold text-sm border border-red-100">
                        <span class="text-2xl mb-1">🚨</span> View Alerts
                    </a>
                    <a href="{{ route('admin.events') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition font-semibold text-sm border border-blue-100">
                        <span class="text-2xl mb-1">📅</span> New Event
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800">Recent Incident Reports</h3>
                    <a href="{{ route('admin.incidents') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-700">View All &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-white text-xs uppercase font-bold text-slate-400 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Location</th>
                                <th class="px-6 py-4">Time</th>
                                <th class="px-6 py-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recentIncidents ?? [] as $incident)
                                <tr class="hover:bg-slate-50 transition cursor-pointer" onclick="window.location='{{ route('admin.incidents.show', $incident->id) }}'">
                                    <td class="px-6 py-4 font-bold text-slate-800">{{ $incident->incident_type }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($incident->location_details, 20) }}</td>
                                    <td class="px-6 py-4">{{ $incident->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="px-3 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider {{ $incident->status === 'Pending' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700' }}">
                                            {{ $incident->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-8 text-center text-slate-500">No recent incidents. All clear!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Event Calendar</h3>
                <div id="dashboard-calendar" class="text-xs"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('dashboard-calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'listMonth', 
                    headerToolbar: { left: 'prev,next', center: 'title', right: '' },
                    height: 450,
                    themeSystem: 'standard',
                    events: [
                        @foreach($events ?? [] as $event)
                        {
                            title: '{!! addslashes($event->event_name) !!}',
                            start: '{{ \Carbon\Carbon::parse($event->event_date)->toIso8601String() }}',
                            url: '{{ route("admin.events.show", $event->id) }}',
                            color: '#059669' // Emerald 600
                        },
                        @endforeach
                    ]
                });
                calendar.render();
            }
        });
    </script>
</x-admin-layout>