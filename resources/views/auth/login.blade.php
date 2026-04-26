<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.R.I.M. | Portal Access</title>
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
        <a href="/" class="flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="text-xs font-bold uppercase tracking-widest">Back to Homepage</span>
        </a>
    </div>

    <div class="w-full max-w-[400px]">
        <div class="mb-12 text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-slate-50 border border-slate-100 rounded-2xl mb-6">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Official Resident Gateway</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Welcome Back.</h1>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-300"
                        placeholder="resident@angelescity.gov">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] font-semibold text-slate-400 hover:text-emerald-600 transition">Forgot?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required 
                        class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!--<div class="flex items-center px-1">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 transition cursor-pointer">
                    <label for="remember_me" class="ml-2 text-xs text-slate-500 font-medium cursor-pointer">Remember me on this browser</label>
                </div>-->

                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 transition-all active:scale-[0.98] mt-2">
                    Sign In to B.R.I.M.
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-400">
                Don't have an account yet? 
                <a href="{{ route('register') }}" class="text-slate-900 font-bold hover:text-emerald-600 transition">Register here</a>
            </p>