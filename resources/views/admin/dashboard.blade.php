<x-app-layout>
    <div style="padding: 20px; max-width: 900px; margin: 0 auto;">
        <h2 style="color: red; font-weight: bold; font-size: 24px;">🚨 Secretary Control Panel</h2>
        <p>Welcome back! Select a module below to manage barangay operations.</p>
        <hr style="margin: 15px 0;">

        <a href="{{ route('admin.certificates') }}" style="background: black; color: white; padding: 15px 20px; text-decoration: none; display: inline-block; font-weight: bold; margin-top: 10px;">
            📄 Manage Certificate Requests
        </a>

        <a href="{{ route('admin.events') }}" style="background: black; color: white; padding: 15px 20px; text-decoration: none; display: inline-block; font-weight: bold; margin-top: 10px;">
            🎉 Manage Events
        </a>
    </div>
</x-app-layout>