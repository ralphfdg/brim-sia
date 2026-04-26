<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.R.I.M. | Account Recovery</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; }
        .dot-grid {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="dot-grid min-h-screen flex flex-col items-center justify-center p-6 antialiased">

    <div class="fixed top-8 left-8">
        <a href="{{ route('login') }}" class="flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-xs font-bold uppercase tracking-widest">Return to Login</span>
        </a>
    </div>

    <div class="w-full max-w-[440px]">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-slate-50 border border-slate-100 rounded-2xl mb-6">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Security Recovery</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Lost Access?</h1>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
            <div class="mb-6 text-sm text-slate-600 leading-relaxed">
                {{ __('No problem. Provide your registered email address and we will send a password reset link to your inbox.') }}
            </div>

            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">{{ __('Registered Email') }}</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </span>
                        <x-text-input id="email" 
                            class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-300" 
                            type="email" name="email" :value="old('email')" required autofocus 
                            placeholder="resident@example.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 transition-all active:scale-[0.98] mt-2">
                    {{ __('Send Reset Link') }}
                </button>
            </form>
        </div>
    </div>

</body>
</html>