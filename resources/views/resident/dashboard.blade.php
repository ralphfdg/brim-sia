<x-resident-layout>
    <x-slot name="header">
        Welcome Back, {{ explode(' ', auth()->user()->name)[0] }} 👋
    </x-slot>

    <div class="space-y-6">
        <!-- Welcome Banner & Weather -->
        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-3xl shadow-xl overflow-hidden relative">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
            
            <div class="p-8 sm:p-10 relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="text-white">
                    <h2 class="text-3xl font-extrabold mb-2 text-white/90">Barangay Resident Portal</h2>
                    <p class="text-emerald-100 max-w-xl text-lg">Access your community services, request certificates, and report incidents all in one place.</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 min-w-[240px] flex items-center justify-between">
                    <div>
                        <h3 class="text-emerald-100 font-medium mb-1">East Calaguiman Weather</h3>
                        <p id="weather-text" class="text-sm text-white/70">Loading status...</p>
                    </div>
                    <div id="weather-temp" class="text-4xl font-black text-white ml-4">--°</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h3 class="text-xl font-bold text-slate-800 mb-4 px-2">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Certificate Request -->
                <a href="{{ route('resident.certificates') }}" class="group relative bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Request Certificate</h3>
                    <p class="text-sm text-slate-500">Get barangay clearance, indigency, and other documents instantly.</p>
                    <div class="mt-4 flex items-center text-emerald-600 text-sm font-semibold">
                        <span>Get Started</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Report Incident -->
                <a href="{{ route('resident.incidents') }}" class="group relative bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Report Incident</h3>
                    <p class="text-sm text-slate-500">Alert barangay officials and tanods about issues or emergencies in your area.</p>
                    <div class="mt-4 flex items-center text-red-600 text-sm font-semibold">
                        <span>File Report</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>

                <!-- Community Events -->
                <a href="{{ route('resident.events') }}" class="group relative bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -z-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Community Events</h3>
                    <p class="text-sm text-slate-500">View and join upcoming activities, assemblies, and programs.</p>
                    <div class="mt-4 flex items-center text-emerald-600 text-sm font-semibold">
                        <span>View Calendar</span>
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('/api/weather')
                .then(response => {
                    document.getElementById('weather-text').innerText = (response.data.is_day === 'Yes' ? 'Daytime' : 'Nighttime');
                    document.getElementById('weather-temp').innerText = response.data.temperature + '°';
                })
                .catch(error => {
                    document.getElementById('weather-text').innerText = "Unavailable";
                });
        });
    </script>
</x-resident-layout>