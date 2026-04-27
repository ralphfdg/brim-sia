<x-resident-layout>
    <x-slot name="header">
        Community Events
    </x-slot>

    <div class="space-y-6">
        
        <!-- Welcome banner -->
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-2xl shadow-sm p-8 text-white relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-extrabold mb-2 text-white">Discover Local Events</h2>
                <p class="text-emerald-100 max-w-2xl text-lg">Join assemblies, workshops, and community gatherings right here in the barangay.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Left Column: Upcoming & Joined Events -->
            <div class="xl:col-span-2 space-y-6">
                
                <!-- Upcoming Events Tab -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Upcoming Events
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($events as $event)
                                <div class="group border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 bg-white flex flex-col h-full">
                                    <div class="p-6 flex-1 flex flex-col relative">
                                        <!-- Price Tag -->
                                        <div class="absolute top-4 right-4 px-3 py-1 text-xs font-bold rounded-full {{ $event->registration_fee > 0 ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $event->registration_fee > 0 ? '₱' . number_format($event->registration_fee, 2) : 'FREE' }}
                                        </div>
                                        
                                        <p class="text-emerald-600 font-bold text-xs uppercase tracking-wider mb-2">
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                        </p>
                                        <h4 class="text-lg font-bold text-slate-800 mb-2 line-clamp-2">{{ $event->event_name }}</h4>
                                        
                                        <div class="mt-auto space-y-2 text-sm text-slate-500 pt-4">
                                            <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 mt-0.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 mt-0.5 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                <span class="line-clamp-1">{{ $event->location ?? 'TBA' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end">
                                        <a href="{{ route('resident.events.show', $event->id) }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800 transition-colors flex items-center gap-1 group-hover:underline">
                                            View Details
                                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-12 flex flex-col items-center justify-center text-slate-500 border-2 border-dashed border-slate-200 rounded-2xl">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="font-medium">No upcoming events right now.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Joined Events -->
                @if($joinedEvents->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-lg font-bold text-slate-800">My Registered Events</h3>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($joinedEvents as $registration)
                            <div class="p-4 sm:p-6 hover:bg-slate-50 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <h4 class="text-base font-bold text-slate-800">{{ $registration->event->event_name }}</h4>
                                    <div class="text-sm text-slate-500 mt-1 flex flex-wrap items-center gap-x-4 gap-y-1">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($registration->event->event_date)->format('M d, Y h:i A') }}
                                        </span>
                                        @if($registration->payment_status === 'Paid')
                                            <span class="flex items-center gap-1 text-emerald-600 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Paid
                                            </span>
                                        @elseif($registration->payment_status === 'Free')
                                            <span class="flex items-center gap-1 text-emerald-600 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Free Ticket
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('resident.events.show', $registration->event_id) }}" class="inline-flex shrink-0 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                                    View Event
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Calendar -->
            <div class="xl:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-28">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-lg font-bold text-slate-800">Event Calendar</h3>
                    </div>
                    <div class="p-4">
                        <div id="calendar" class="text-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $calendarEvents = $events->map(function($event) {
            return [
                'id' => $event->id,
                'title' => $event->event_name,
                'start' => \Carbon\Carbon::parse($event->event_date)->toIso8601String(),
                'url' => route('resident.events.show', $event->id),
                'color' => '#10b981' // Emerald
            ];
        });
    @endphp

    <!-- Calendar Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventsData = @json($calendarEvents);
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: '' // hidden to save space
                },
                height: 450,
                events: eventsData,
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
                    }
                }
            });
            calendar.render();
        });
    </script>
    
    <style>
        /* Custom Calendar Styling */
        .fc .fc-toolbar-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
        }
        .fc .fc-button-primary {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #475569;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .fc .fc-button-primary:not(:disabled):active,
        .fc .fc-button-primary:hover {
            background-color: #e2e8f0;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        .fc-theme-standard td, .fc-theme-standard th, .fc-theme-standard .fc-scrollgrid {
            border-color: #f1f5f9;
        }
        .fc .fc-daygrid-day-number {
            color: #475569;
            font-weight: 500;
        }
        .fc-day-today {
            background-color: #f8fafc !important;
        }
        .fc-event {
            cursor: pointer;
            border: none;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
</x-resident-layout>