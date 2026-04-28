<x-admin-layout>
    <x-slot name="header">Manage Events & Calendar</x-slot>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <div class="xl:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-8">
                <div class="px-6 py-5 border-b border-slate-100 bg-[#0f172a] text-white">
                    <h3 class="text-xl font-black flex items-center gap-2">
                        <span>🎉</span> Create Event
                    </h3>
                    <p class="text-slate-400 text-xs mt-1">Publish an upcoming activity for the barangay.</p>
                </div>

                <div class="p-6">
                    <div id="event-msg-container" class="hidden mb-6 p-4 rounded-xl font-bold text-sm border transition-all">
                        <span id="event-msg"></span>
                    </div>

                    <form id="create-event-form" class="space-y-5 text-sm">
                        <div>
                            <label for="event_name" class="block font-bold text-slate-700 mb-1">Event Name <span class="text-red-500">*</span></label>
                            <input type="text" id="event_name" required class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm placeholder-slate-400 font-medium" placeholder="e.g. Summer Basketball Liga">
                        </div>

                        <div>
                            <label for="event_date" class="block font-bold text-slate-700 mb-1">Event Date & Time <span class="text-red-500">*</span></label>
                            <input type="datetime-local" id="event_date" required class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm font-medium text-slate-700">
                        </div>

                        <div>
                            <label for="location" class="block font-bold text-slate-700 mb-1">Location</label>
                            <input type="text" id="location" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm placeholder-slate-400 font-medium" placeholder="e.g. Barangay Court">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="max_attendees" class="block font-bold text-slate-700 mb-1">Max Attendees</label>
                                <input type="number" id="max_attendees" min="1" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm placeholder-slate-400 font-medium" placeholder="Unlimited">
                            </div>

                            <div>
                                <label for="registration_fee" class="block font-bold text-slate-700 mb-1">Fee (₱) <span class="text-red-500">*</span></label>
                                <input type="number" id="registration_fee" required step="0.01" value="0.00" min="0" class="w-full bg-slate-50 border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm font-medium text-slate-700">
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl shadow-sm text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all">
                                Publish Event
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <h3 class="text-xl font-black text-slate-800">Barangay Event Calendar</h3>
                    <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider border border-emerald-200">Live View</span>
                </div>
                
                <div id="calendar" class="min-h-[600px] z-0 relative font-sans"></div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'standard',
                eventColor: '#059669', // Emerald 600 to match the theme
                height: 'auto',
                events: [
                    // Load existing events from the database
                    @foreach($events ?? [] as $event)
                    {
                        title: '{!! addslashes($event->event_name) !!}',
                        start: '{{ \Carbon\Carbon::parse($event->event_date)->toIso8601String() }}',
                        url: '{{ route("admin.events.show", $event->id) }}'
                    },
                    @endforeach
                ]
            });
            calendar.render();

            // 2. Form Submission Logic
            document.getElementById('create-event-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const container = document.getElementById('event-msg-container');
                const msg = document.getElementById('event-msg');
                
                // Reset state to loading
                container.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'bg-red-50', 'text-red-700', 'border-red-200', 'bg-amber-50', 'text-amber-700', 'border-amber-200');
                container.classList.add('bg-amber-50', 'text-amber-700', 'border-amber-200', 'block');
                msg.innerText = "⏳ Publishing event...";

                // Capture input values
                const eventName = document.getElementById('event_name').value;
                const eventDate = document.getElementById('event_date').value;
                const location = document.getElementById('location').value;
                const maxAttendees = document.getElementById('max_attendees').value || null;
                const registrationFee = document.getElementById('registration_fee').value;
                
                // Send the POST request
                axios.post('/admin/events', {
                    event_name: eventName,
                    event_date: eventDate,
                    location: location,
                    max_attendees: maxAttendees,
                    registration_fee: registrationFee,
                })
                .then(res => {
                    // Show Success
                    container.classList.remove('bg-amber-50', 'text-amber-700', 'border-amber-200');
                    container.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                    msg.innerText = "✅ Success! Event Published.";
                    
                    // Dynamically add the newly created event to the calendar UI
                    calendar.addEvent({
                        title: eventName,
                        start: eventDate,
                        url: `/admin/events/${res.data.data.id}` // Link to the new event page
                    });

                    // Clear the form
                    document.getElementById('create-event-form').reset();
                    
                    // Hide success message after 4 seconds
                    setTimeout(() => {
                        container.classList.add('hidden');
                    }, 4000);
                })
                .catch(err => {
                    // Show Error
                    container.classList.remove('bg-amber-50', 'text-amber-700', 'border-amber-200');
                    container.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
                    msg.innerText = "❌ Failed to publish event. Please check inputs.";
                    console.error(err);
                });
            });
        });
    </script>
</x-admin-layout>