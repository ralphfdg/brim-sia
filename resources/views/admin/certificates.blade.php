<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Manage Certificate Requests') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-emerald-400">
                <div class="p-6 text-slate-900">
                    <h3 class="text-2xl font-bold mb-1">Paid Certificate Requests</h3>
                    <p class="text-gray-600 text-sm">These residents have completed payment. Click "Approve" to finalize their request and generate the PDF document.</p>
                </div>
            </div>

            <div id="admin-status-container" class="hidden mb-6 p-4 rounded-md font-medium text-sm border">
                <span id="admin-status-msg"></span>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-900 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Tracking #</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Resident Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Document Type</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-medium uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($certificates as $cert)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">
                                        {{ $cert->tracking_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                        {{ $cert->resident->first_name }} {{ $cert->resident->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-slate-900">
                                            {{ $cert->certificate_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="approveCertificate('{{ $cert->id }}')" class="inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Approve & Generate
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            <p class="text-base font-medium text-slate-900">No pending paid requests at this time.</p>
                                            <p class="text-sm mt-1">All caught up!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function approveCertificate(certificateId) {
            const container = document.getElementById('admin-status-container');
            const msg = document.getElementById('admin-status-msg');
            
            // Reset state
            container.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'bg-red-50', 'text-red-700', 'border-red-200');
            
            // Show loading state
            container.classList.add('bg-yellow-50', 'text-yellow-700', 'border-yellow-200', 'block');
            msg.innerText = "⏳ Triggering backend automation...";

            // Maintain the existing logic from the backend team
            axios.put(`/admin/certificates/${certificateId}`, {
                request_status: 'Ready'
            })
            .then(res => {
                container.classList.remove('bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                container.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                msg.innerText = "✅ Success! Document is being generated. Refreshing table...";
                
                setTimeout(() => window.location.reload(), 1500);
            })
            .catch(err => {
                container.classList.remove('bg-yellow-50', 'text-yellow-700', 'border-yellow-200');
                container.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
                msg.innerText = "❌ Error: Could not process approval.";
                console.error(err);
            });
        }
    </script>
</x-app-layout>