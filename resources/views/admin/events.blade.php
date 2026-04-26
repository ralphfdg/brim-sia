<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Manage Events & Calendar') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-6">
                
                <div class="w-full lg:w-1/3 flex flex-col gap-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-slate-900">
                        <div class="p-6 text-slate-900">
                            <h3 class="text-xl font-bold mb-1">🎉 Create Event</h3>
                            <p class="text-gray-600 text-xs mb-4">Publish an upcoming activity for the barangay residents.</p>

                            <div id="event-msg-container" class="hidden mb-4 p-3 rounded-md font-medium text-sm border">
                                <span id="event-msg"></span>
                            </div>

                            <form id="create-event-form" class="space-y-4 text-sm">
                                <div>
                                    <label for="event_name" class="block font-medium text-slate-900">Event Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="event_name" required class="mt-1 block w-full border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 rounded-md shadow-sm placeholder-gray-400" placeholder="e.g. Summer Basketball Liga">
                                </div>

                                <div>
                                    <label for="event_date" class="block font-medium text-slate-900">Event Date & Time <span class="text-red-500">*</span></label>
                                    <input type="datetime-local" id="event_date" required class="mt-1 block w-full border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 rounded-md shadow-sm">
                                </div>

                                <div>
                                    <label for="location" class="block font-medium text-slate-900">Location</label>
                                    <input type="text" id="location" class="mt-1 block w-full border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 rounded-md shadow-sm placeholder-gray-400" placeholder="e.g. Barangay Court">
                                </div>
                                
                                <div>
                                    <label for="max_attendees" class="block font-medium text-slate-900">Max Attendees</label>
                                    <p class="text-xs text-gray-500 mb-1">Leave blank for unlimited</p>
                                    <input type="number" id="max_attendees" min="1" class="block w-full border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 rounded-md shadow-sm placeholder-gray-400" placeholder="Unlimited">
                                </div>

                                <div>
                                    <label for="registration_fee" class="block font-medium text-slate-900">Registration Fee (₱) <span class="text-red-500">*</span></label>
                                    <input type="number" id="registration_fee" required step="0.01" value="0.00" min="0" class="mt-1 block w-full border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 rounded-md shadow-sm">
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-400 transition-colors duration-200">
                                        Publish Event
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-slate-900">Barangay Event Calendar</h3>
                            <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">Live View</span>
                        </div>
                        <div id="calendar" class="min-h-[500px]"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Calendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'standard',
                eventColor: '#10b981', // Matches the Primary Emerald color
                height: 'auto'
            });
            calendar.render();

            // Form Submission Logic
            document.getElementById('create-event-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const container = document.getElementById('event-msg-container');
                const msg = document.getElementById('event-msg');
                
                // Reset state
                container.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'bg-red-50', 'text-red-700', 'border-red-200', 'bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                container.classList.add('bg-yellow-50', 'text-yellow-700', 'border-yellow-200', 'block');
                msg.innerText = "⏳ Publishing event...";

                // Capture values
                const eventName = document.getElementById('event_name').value;
                const eventDate = document.getElementById('event_date').value;
                const location = document.getElementById('location').value;
                const maxAttendees = document.getElementById('max_attendees').value || null;
                const registrationFee = document.getElementById('registration_fee').value;
                
                // Unchanged Axios POST request to preserve controller logic
                axios.post('/admin/events', {
                    event_name: eventName,
                    event_date: eventDate,
                    location: location,
                    max_attendees: maxAttendees,
                    registration_fee: registrationFee,
                })
                .then(res => {
                    container.classList.remove('bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                    container.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                    msg.innerText = "✅ Success! Event Published.";
                    
                    // Dynamically add the newly created event to the calendar UI
                    calendar.addEvent({
                        title: eventName,
                        start: eventDate,
                        allDay: false
                    });

                    document.getElementById('create-event-form').reset();
                    
                    // Hide success message after 4 seconds
                    setTimeout(() => {
                        container.classList.add('hidden');
                    }, 4000);
                })
                .catch(err => {
                    container.classList.remove('bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                    container.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
                    msg.innerText = "❌ Failed to publish event. Please check inputs.";
                    console.error(err);
                });
            });
        });
    </script>
</x-app-layout>