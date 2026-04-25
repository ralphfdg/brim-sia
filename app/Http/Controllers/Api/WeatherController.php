<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Fetch live weather data for Angeles City from an External API
     */
    public function current()
    {
        // Angeles City, Pampanga Coordinates
        $latitude = 15.1444;
        $longitude = 120.5886;

        try {
            // Requirement 4.3: Consuming an External API
            $response = Http::timeout(5)->get("https://api.open-meteo.com/v1/forecast", [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'current_weather' => true,
                'timezone' => 'Asia/Manila'
            ]);

            if ($response->successful()) {
                $weatherData = $response->json('current_weather');

                return response()->json([
                    'message' => 'Weather data fetched successfully from Open-Meteo.',
                    'location' => 'Angeles City, Pampanga',
                    'temperature' => $weatherData['temperature'] . '°C',
                    'windspeed' => $weatherData['windspeed'] . ' km/h',
                    'is_day' => $weatherData['is_day'] == 1 ? 'Yes' : 'No',
                    'raw_data' => $weatherData
                ], 200);
            }

            return response()->json(['message' => 'External weather service is currently unavailable.'], 503);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to connect to the external API.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}