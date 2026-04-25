<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Certificate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-green-600">Certificate Request Form Will Go Here</h3>
                <p class="text-gray-600">This is where we will put the Stripe Checkout button.</p>
            </div>
        </div>
    </div>
</x-app-layout>