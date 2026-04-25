<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resident Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg border border-blue-200">
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-blue-800">Live Weather: Angeles City</h3>
                        <p id="weather-text" class="text-sm text-gray-600">Loading weather data from Open-Meteo API...</p>
                    </div>
                    <div id="weather-temp" class="text-3xl font-black text-blue-600">--°C</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('incidents') }}" class="block p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 border border-gray-200">
                    <h3 class="text-lg font-bold text-red-600">🚨 Report Incident</h3>
                    <p class="text-sm text-gray-600">Alert the Barangay Tanod instantly.</p>
                </a>
                <a href="{{ route('certificates') }}" class="block p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 border border-gray-200">
                    <h3 class="text-lg font-bold text-green-600">📄 Request Certificate</h3>
                    <p class="text-sm text-gray-600">Get clearance documents & pay online.</p>
                </a>
                <a href="{{ route('events') }}" class="block p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 border border-gray-200">
                    <h3 class="text-lg font-bold text-purple-600">📅 Community Events</h3>
                    <p class="text-sm text-gray-600">Join upcoming barangay activities.</p>
                </a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // We use Axios to securely fetch data from your backend API
            axios.get('/api/weather')
                .then(response => {
                    document.getElementById('weather-text').innerText = "Currently: " + (response.data.is_day === 'Yes' ? 'Daytime' : 'Nighttime');
                    document.getElementById('weather-temp').innerText = response.data.temperature;
                })
                .catch(error => {
                    document.getElementById('weather-text').innerText = "Failed to load weather API.";
                });
        });
    </script>
</x-app-layout>