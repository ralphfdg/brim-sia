<x-resident-layout>
    <x-slot name="header">
        Certificate Requests
    </x-slot>

    <div class="space-y-6">
        
        <!-- Request New Certificate Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">📄 Request New Document</h3>
                <span class="text-sm font-medium px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full">Processing Fee: ₱50.00</span>
            </div>
            
            <div class="p-6">
                <form id="certificate-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Document Type</label>
                            <select id="certificate_type" required class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm px-4 py-2">
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="Certificate of Residency">Certificate of Residency</option>
                                <option value="Business Clearance">Business Clearance</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Purpose of Request</label>
                            <input type="text" id="purpose" required class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm px-4 py-2" placeholder="e.g., Employment, Bank Requirements...">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between pt-2">
                        <p id="status-msg" class="text-sm font-medium"></p>
                        <button type="submit" id="submit-btn" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span>Proceed to Payment</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- History Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <h3 class="text-lg font-bold text-slate-800">My Requests History</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 tracking-wider">Tracking #</th>
                            <th class="px-6 py-3 tracking-wider">Document Type</th>
                            <th class="px-6 py-3 tracking-wider">Date Requested</th>
                            <th class="px-6 py-3 tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($certificates as $cert)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">
                                    {{ $cert->tracking_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $cert->certificate_type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $cert->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($cert->request_status === 'Pending')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                    @elseif($cert->request_status === 'Processing')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">Processing</span>
                                    @elseif($cert->request_status === 'Ready')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-400/20 text-emerald-700">Ready for Pickup</span>
                                    @elseif($cert->request_status === 'Claimed')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Claimed</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">{{ $cert->request_status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('resident.certificates.show', $cert->id) }}" class="text-emerald-600 hover:text-emerald-800 font-medium text-sm transition-colors">View Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p>You haven't requested any certificates yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-100">
                {{ $certificates->links() }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('certificate-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const msg = document.getElementById('status-msg');
            const btn = document.getElementById('submit-btn');

            msg.innerText = "⏳ Generating secure payment link...";
            msg.className = "text-sm font-medium text-amber-600";
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            const data = {
                certificate_type: document.getElementById('certificate_type').value,
                purpose: document.getElementById('purpose').value
            };

            axios.post('{{ route('resident.certificates') }}', data)
                .then(res => {
                    msg.innerText = "✅ Success! Redirecting to Stripe...";
                    msg.className = "text-sm font-medium text-green-600";
                    window.location.href = res.data.payment_link;
                })
                .catch(err => {
                    msg.innerText = "❌ Error: Could not process request.";
                    msg.className = "text-sm font-medium text-red-600";
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');
                });
        });
    </script>
</x-resident-layout>