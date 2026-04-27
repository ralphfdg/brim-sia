<x-resident-layout>
    <x-slot name="header">
        Incident Report Details
    </x-slot>

    <div class="space-y-6">
        <a href="{{ route('resident.incidents') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition-colors font-medium text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Incidents
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-3xl">
            <!-- Header Status -->
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
                    <div>
                        <p class="text-slate-400 font-medium text-sm mb-1">Reported On</p>
                        <h2 class="text-2xl font-bold tracking-tight">{{ $incident->created_at->format('F d, Y \a\t h:i A') }}</h2>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        @if($incident->status === 'Pending')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-yellow-500/20 text-yellow-300 shadow-sm border border-yellow-500/30">Pending Review</span>
                        @elseif($incident->status === 'Dispatched')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-emerald-500/20 text-emerald-300 shadow-sm border border-emerald-500/30">Dispatched</span>
                        @elseif($incident->status === 'Resolved')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-emerald-400/20 text-emerald-300 shadow-sm border border-emerald-400/30">Resolved</span>
                        @else
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-white/10 text-white shadow-sm">{{ $incident->status ?? 'Reported' }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details Body -->
            <div class="p-8">
                <div class="space-y-6">
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Incident Type</h4>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full @if($incident->incident_type == 'Fire Emergency' || $incident->incident_type == 'Crime/Suspicious Activity') bg-red-500 @else bg-orange-400 @endif"></div>
                            <p class="text-xl font-bold text-slate-800">{{ $incident->incident_type }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Specific Location</h4>
                            <p class="text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $incident->location_details }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Detailed Description</h4>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-slate-700 whitespace-pre-line leading-relaxed">
                            {{ $incident->description }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 text-sm text-slate-500">
                Report UUID: {{ $incident->id }}
            </div>
        </div>
    </div>
</x-resident-layout>
