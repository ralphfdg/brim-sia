<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'B.R.I.M.') }} | Portal Access</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            /* Subtle off-white background to make the pure white card "pop" */
            background-color: #f8fafc; 
        }
        
        .dot-grid {
            /* Darker, more defined dots for depth */
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* High-Visibility Card Shadow */
        .elevated-card {
            background: #ffffff;
            box-shadow: 
                0 1px 3px 0 rgba(0, 0, 0, 0.1), 
                0 25px 50px -12px rgba(0, 0, 0, 0.15), 
                0 0 0 1px rgba(0, 0, 0, 0.05); /* Soft border ring */
        }

        .form-input-focus:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .fade-in {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="dot-grid min-h-screen flex flex-col items-center justify-center p-6 antialiased">

    <div class="fixed top-8 left-8 hidden md:block">
        <a href="/" class="flex items-center gap-2 text-slate-400 hover:text-emerald-600 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-xs font-bold uppercase tracking-widest">Back to Homepage</span>
        </a>
    </div>

    <div class="w-full max-w-[420px] fade-in">
        <div class="mb-10 text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-white border border-slate-200 rounded-2xl mb-6 shadow-sm">
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Official Resident Gateway</span>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tighter">Welcome Back.</h1>
            <p class="text-slate-500 text-sm mt-2">Sign in to access your B.R.I.M. portal account.</p>
        </div>

        <div class="elevated-card border border-slate-300 rounded-[2.5rem] p-8 md:p-10">
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm transition-all form-input-focus placeholder:text-slate-300"
                        placeholder="resident@angelescity.gov">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-emerald-600 hover:text-emerald-700 transition uppercase tracking-tighter">Forgot Password?</a>
                        @endif
                    </div>
                    
                    <div class="relative">
                        <input id="password" type="password" name="password" required 
                            class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm transition-all form-input-focus pr-12"
                            placeholder="••••••••">
                        
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-600 transition-colors focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all active:scale-[0.98]">
                    Sign In to Portal
                </button>
            </form>
        </div>

        <div class="mt-10 text-center">
            <p class="text-sm text-slate-400 font-medium">
                Don't have an account yet? 
                <a href="{{ route('register') }}" class="text-slate-900 font-bold hover:text-emerald-600 transition underline underline-offset-4 decoration-slate-200">Register here</a>
            </p>
        </div>
    </div>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Change icon to "eye-slash"
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            `;
        } else {
            passwordInput.type = 'password';
            // Change icon back to "eye"
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            `;
        }
    }
</script>

</body>
</html>