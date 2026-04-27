<x-resident-layout>
    <x-slot name="header">
        Event Details
    </x-slot>

    <div class="space-y-6">
        <a href="{{ route('resident.events') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition-colors font-medium text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Events
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl">
            <!-- Header Image & Info -->
            <div class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 h-64 flex items-end p-8 text-white overflow-hidden">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                <div class="absolute top-4 right-4 flex gap-2">
                    @if($isRegistered)
                        <span class="px-4 py-2 bg-emerald-500 text-white text-sm font-bold rounded-full shadow-lg flex items-center gap-2 border border-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Registered
                        </span>
                    @endif
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-md text-white text-sm font-bold rounded-full shadow-sm border border-white/30">
                        {{ $event->registration_fee > 0 ? '₱' . number_format($event->registration_fee, 2) : 'FREE EVENT' }}
                    </span>
                </div>
                
                <div class="relative z-10 w-full">
                    <p class="text-emerald-200 font-bold text-sm tracking-wider uppercase mb-2">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y \a\t g:i A') }}</p>
                    <h2 class="text-3xl md:text-4xl font-black tracking-tight mb-2">{{ $event->event_name }}</h2>
                    <p class="text-emerald-100 font-medium flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->location ?? 'To Be Announced' }}
                    </p>
                </div>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column: Description -->
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">About This Event</h3>
                        <div class="prose prose-slate max-w-none text-slate-600">
                            {{ $event->description ?? 'No detailed description available for this event.' }}
                        </div>
                    </div>
                    
                    @if($isRegistered)
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 flex items-start gap-4">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-emerald-800">You are registered!</h4>
                                <p class="text-emerald-700 text-sm mt-1">We look forward to seeing you there. Check your email for further instructions or updates regarding this event.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Action / Details -->
                <div class="space-y-6">
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Event Summary</h3>
                        
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <div>
                                    <p class="font-medium text-slate-800">Date</p>
                                    <p class="text-slate-500">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="font-medium text-slate-800">Time</p>
                                    <p class="text-slate-500">{{ \Carbon\Carbon::parse($event->event_date)->format('g:i A') }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div>
                                    <p class="font-medium text-slate-800">Location</p>
                                    <p class="text-slate-500">{{ $event->location ?? 'TBA' }}</p>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-6 pt-6 border-t border-slate-200">
                            @if(!$isRegistered)
                                <button onclick="registerForEvent('{{ $event->id }}')" id="register-btn" class="w-full py-3 px-4 rounded-xl font-bold text-white shadow-sm transition-all flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700">
                                    @if($event->registration_fee > 0)
                                        Pay ₱{{ number_format($event->registration_fee, 2) }} & Join
                                    @else
                                        Register for Free
                                    @endif
                                </button>
                                <p id="event-status-msg" class="text-center text-sm font-medium mt-3"></p>
                            @else
                                <button disabled class="w-full py-3 px-4 rounded-xl font-bold text-slate-500 bg-slate-200 cursor-not-allowed">
                                    Already Registered
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$isRegistered)
    <script>
        function registerForEvent(eventId) {
            const msg = document.getElementById('event-status-msg');
            const btn = document.getElementById('register-btn');
            
            msg.innerText = "⏳ Processing registration...";
            msg.className = "text-center text-sm font-medium mt-3 text-amber-600";
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            axios.post('/event-registrations', { event_id: eventId })
            .then(res => {
                if (res.data.payment_link) {
                    msg.innerText = "✅ Success! Redirecting to secure payment...";
                    msg.className = "text-center text-sm font-medium mt-3 text-green-600";
                    window.location.href = res.data.payment_link;
                } else {
                    msg.innerText = "✅ Successfully registered! Refreshing page...";
                    msg.className = "text-center text-sm font-medium mt-3 text-green-600";
                    setTimeout(() => window.location.reload(), 1500);
                }
            })
            .catch(err => {
                msg.innerText = "❌ " + (err.response?.data?.error || "Could not register.");
                msg.className = "text-center text-sm font-medium mt-3 text-red-600";
                
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
                console.error(err);
            });
        }
    </script>
    @endif
</x-resident-layout>
