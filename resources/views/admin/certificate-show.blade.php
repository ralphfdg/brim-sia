<x-admin-layout>
    <x-slot name="header">Process Certificate</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.certificates') }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-700">&larr; Back to Queue</a>
    </div>

    <div class="bg-white max-w-2xl mx-auto rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tracking Number</p>
                <p class="font-mono text-lg font-black text-slate-800">{{ $certificate->tracking_number }}</p>
            </div>
            <span class="px-4 py-1.5 rounded-full text-sm font-bold {{ $certificate->payment_status == 'Paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                {{ $certificate->payment_status }}
            </span>
        </div>

        <div class="p-8 space-y-6">
            <div>
                <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">Document Type</h4>
                <p class="text-xl font-bold text-slate-800">{{ $certificate->certificate_type }}</p>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">Resident</h4>
                    <p class="font-medium text-slate-800">{{ $certificate->resident->first_name ?? '' }} {{ $certificate->resident->last_name ?? '' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">Date Requested</h4>
                    <p class="font-medium text-slate-800">{{ $certificate->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-1">Purpose</h4>
                <p class="text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $certificate->purpose }}</p>
            </div>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
            <span class="text-sm font-bold text-slate-500">Current Status: <span class="text-slate-800">{{ $certificate->request_status }}</span></span>
            
            @if($certificate->payment_status == 'Paid' && $certificate->request_status == 'Pending')
                <button onclick="updateCert('Ready')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-xl transition-all shadow-sm">
                    Mark Document as Ready
                </button>
            @elseif($certificate->request_status == 'Ready')
                <button onclick="updateCert('Claimed')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl transition-all shadow-sm">
                    Mark as Claimed
                </button>
            @endif
        </div>
    </div>

    <script>
        function updateCert(status) {
            if(!confirm(`Are you sure you want to mark this document as ${status}?`)) return;
            
            fetch(`/admin/certificates/{{ $certificate->id }}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ request_status: status })
            }).then(res => res.json()).then(data => {
                window.location.reload();
            });
        }
    </script>
</x-admin-layout>