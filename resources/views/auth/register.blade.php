<x-guest-layout>
 <form method="POST" action="{{ route('register') }}">
    @csrf

    <h3 class="font-bold border-b mb-4">Login Credentials</h3>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="email" :value="__('Email (Username)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
        </div>
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>
    </div>

    <h3 class="font-bold border-b mt-6 mb-4">Official Resident Profile</h3>
    
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-1">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" required />
        </div>
        <div class="col-span-1">
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" />
        </div>
        <div class="col-span-1">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" required />
        </div>
        <div class="col-span-1">
            <x-input-label for="suffix" :value="__('Suffix (Jr, III)')" />
            <x-text-input id="suffix" class="block mt-1 w-full" type="text" name="suffix" />
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-4">
        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" required />
        </div>
        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <x-input-label for="civil_status" :value="__('Civil Status')" />
            <select name="civil_status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Legally Separated">Legally Separated</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" />
        </div>
        <div>
            <x-input-label for="occupation" :value="__('Occupation')" />
            <x-text-input id="occupation" class="block mt-1 w-full" type="text" name="occupation" />
        </div>
    </div>

    <div class="mt-4">
        <x-input-label for="purok_or_street" :value="__('Purok / Street Address')" />
        <x-text-input id="purok_or_street" class="block mt-1 w-full" type="text" name="purok_or_street" required />
    </div>

    <div class="mt-4 flex items-center">
        <input type="checkbox" name="is_registered_voter" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <span class="ms-2 text-sm text-gray-600">{{ __('Are you a registered voter in this Barangay?') }}</span>
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Register Resident Account') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>
