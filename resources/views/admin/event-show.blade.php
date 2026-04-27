<x-admin-layout>
    <x-slot name="header">Manage Event</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.events') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-700">&larr; Back to Calendar</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#0f172a] rounded-2xl p-8 shadow-lg text-white">
                <p class="text-emerald-400 font-bold mb-2">{{ \Carbon\Carbon::parse($event->event_date)->format('l, F j, Y') }}</p>
                <h2 class="text-3xl font-black mb-4">{{ $event->event_name }}</h2>
                <div class="space-y-3 text-sm text-slate-300">
                    <p>📍 {{ $event->location ?? 'TBA' }}</p>
                    <p>🎟️ {{ $event->registration_fee > 0 ? '₱' . number_format($event->registration_fee, 2) : 'Free Entry' }}</p>
                    <p>👥 Capacity: {{ $event->max_attendees ?? 'Unlimited' }}</p>
                </div>
                <div class="mt-6 pt-6 border-t border-slate-700">
                    <p class="text-sm text-slate-400 leading-relaxed">{{ $event->description }}</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Registered</h3>
                    <p class="text-3xl font-black text-slate-800">{{ $event->registrations->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800">Attendee Roster</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-white text-xs uppercase font-bold text-slate-400 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Resident Name</th>
                                <th class="px-6 py-4">Registration Date</th>
                                <th class="px-6 py-4">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($event->registrations as $reg)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4 font-bold text-slate-800">{{ $reg->resident->first_name ?? 'N/A' }} {{ $reg->resident->last_name ?? '' }}</td>
                                    <td class="px-6 py-4">{{ $reg->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $reg->payment_status == 'Paid' || $reg->payment_status == 'Free' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $reg->payment_status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                        No residents have registered for this event yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>