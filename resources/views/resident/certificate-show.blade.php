<x-resident-layout>
    <x-slot name="header">
        Certificate Details
    </x-slot>

    <div class="space-y-6">
        <a href="{{ route('resident.certificates') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-800 transition-colors font-medium text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Certificates
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-3xl">
            <!-- Header Ticket -->
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
                    <div>
                        <p class="text-emerald-100 font-medium text-sm mb-1">Tracking Number</p>
                        <h2 class="text-3xl font-black tracking-wider">{{ $certificate->tracking_number }}</h2>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        @if($certificate->request_status === 'Pending')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-yellow-400 text-yellow-900 shadow-sm">Pending Approval</span>
                        @elseif($certificate->request_status === 'Processing')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-emerald-100 text-emerald-800 shadow-sm">Processing</span>
                        @elseif($certificate->request_status === 'Ready')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-emerald-400 text-emerald-900 shadow-sm">Ready for Pickup</span>
                        @elseif($certificate->request_status === 'Claimed')
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-white/20 text-white shadow-sm">Claimed</span>
                        @else
                            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-white/20 text-white shadow-sm">{{ $certificate->request_status }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details Body -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Document Type</h4>
                            <p class="text-lg font-semibold text-slate-800">{{ $certificate->certificate_type }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Purpose</h4>
                            <p class="text-slate-700">{{ $certificate->purpose }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Date Requested</h4>
                            <p class="text-slate-700">{{ $certificate->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Payment Status</h4>
                            @if($certificate->payment_status === 'Paid')
                                <div class="flex items-center text-emerald-600 font-semibold gap-1.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Paid (₱50.00)
                                </div>
                            @else
                                <div class="flex items-center text-red-600 font-semibold gap-1.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Unpaid
                                </div>
                            @endif
                        </div>
                        
                        @if($certificate->payment_status === 'Paid')
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Instructions</h4>
                            <p class="text-sm text-slate-600">Please present your Tracking Number (<strong>{{ $certificate->tracking_number }}</strong>) and a valid ID at the Barangay Hall when your document is ready for pickup.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 text-sm text-slate-500">
                Ticket UUID: {{ $certificate->id }}
            </div>
        </div>
    </div>
</x-resident-layout>
