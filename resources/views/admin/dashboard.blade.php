<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Secretary Control Panel') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border-t-4 border-slate-900">
                <div class="p-6 text-slate-900">
                    <h3 class="text-2xl font-bold mb-2">Welcome back! 👋</h3>
                    <p class="text-gray-600 text-sm">Select a module below to manage barangay operations and oversee resident activities.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300 border border-gray-100 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-emerald-100 rounded-full">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">Certificate Requests</h3>
                            </div>
                            <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">Active</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2">Review, manage, and process pending barangay certificate and clearance requests from residents.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('admin.certificates') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-emerald-500 focus:bg-emerald-500 active:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            Manage Certificates
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300 border border-gray-100 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-emerald-100 rounded-full">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">Events Calendar</h3>
                            </div>
                            <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-3 py-1 rounded-full border border-emerald-200">Active</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2">Schedule new community events, manage current activities, and view the barangay calendar.</p>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('admin.events') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-emerald-500 focus:bg-emerald-500 active:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            Manage Events
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>