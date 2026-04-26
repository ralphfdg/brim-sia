<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'B.R.I.M.') }} | Resident Registration</title>
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=sora:300,400,500,600,700|inter:300,400,500,600,700&display=swap" rel="stylesheet">
      <script src="https://cdn.tailwindcss.com"></script>
      <style>
         body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
         .dot-grid { background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px; }
         .elevated-card {
         background: #ffffff;
         box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
         }
         select {
         appearance: none;
         background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
         background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;
         }
         .form-input-focus:focus { outline: none; border-color: #10b981; box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
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
      <div class="w-full max-w-3xl my-12">
         <div class="mb-8 text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-white border border-slate-200 rounded-2xl mb-6 shadow-sm">
               <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
               <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Official Resident Enrollment</span>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tighter">Create Official Account.</h1>
            <p class="text-slate-500 text-sm mt-2">Provide your legal details to register in the Barangay Information System.</p>
         </div>
         <div class="elevated-card border border-slate-300 rounded-[2.5rem] p-8 md:p-14">
            <p class="text-[10px] text-slate-400 mb-6 text-right italic">Fields marked with <span class="text-red-500">*</span> are required.</p>
            <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="mb-12">
                  <div class="flex items-center gap-4 mb-8">
                     <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-600 text-white text-xs font-bold shadow-lg shadow-emerald-200">01</span>
                     <h3 class="font-bold text-slate-800 uppercase tracking-wider text-sm">Login Credentials</h3>
                     <div class="flex-1 h-px bg-slate-100"></div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                     <div class="space-y-2">
                        <label for="email" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email Address <span class="text-red-500">*</span></label>
                        <input id="email" type="email" name="email" required placeholder="name@example.com"
                           class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="password" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                           <input id="password" type="password" name="password" required
                              class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm transition-all form-input-focus pr-12">
                           <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-slate-400 hover:text-emerald-600 transition-colors focus:outline-none">
                              <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="mb-6">
                  <div class="flex items-center gap-4 mb-8">
                     <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-600 text-white text-xs font-bold shadow-lg shadow-emerald-200">02</span>
                     <h3 class="font-bold text-slate-800 uppercase tracking-wider text-sm">Official Resident Profile</h3>
                     <div class="flex-1 h-px bg-slate-100"></div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                     <div class="space-y-2">
                        <label for="first_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">First Name <span class="text-red-500">*</span></label>
                        <input id="first_name" type="text" name="first_name" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="middle_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Middle Name</label>
                        <input id="middle_name" type="text" name="middle_name" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                     <div class="space-y-2">
                        <label for="last_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Last Name <span class="text-red-500">*</span></label>
                        <input id="last_name" type="text" name="last_name" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="suffix" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Suffix</label>
                        <input id="suffix" type="text" name="suffix" placeholder="Jr., III (Optional)" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                     <div class="space-y-2">
                        <label for="date_of_birth" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Date of Birth <span class="text-red-500">*</span></label>
                        <input id="date_of_birth" type="date" name="date_of_birth" required max="{{ date('Y-m-d') }}" min="1900-01-01" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="gender" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Gender <span class="text-red-500">*</span></label>
                        <select id="gender" name="gender" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                           <option value="" disabled selected>Select Gender</option>
                           <option value="Male">Male</option>
                           <option value="Female">Female</option>
                           <option value="Other">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                     <div class="space-y-2">
                        <label for="contact_number" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Contact Number</label>
                        <input id="contact_number" type="text" name="contact_number" placeholder="09XXXXXXXXX" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="civil_status" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Civil Status <span class="text-red-500">*</span></label>
                        <select id="civil_status" name="civil_status" required class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                           <option value="" disabled selected>Select Status</option>
                           <option value="Single">Single</option>
                           <option value="Married">Married</option>
                           <option value="Widowed">Widowed</option>
                           <option value="Legally Separated">Legally Separated</option>
                        </select>
                     </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                     <div class="space-y-2">
                        <label for="occupation" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Occupation</label>
                        <input id="occupation" type="text" name="occupation" placeholder="e.g. Employee, Student" 
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                     <div class="space-y-2">
                        <label for="purok_or_street" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1">Purok / Street Address <span class="text-red-500">*</span></label>
                        <input id="purok_or_street" type="text" name="purok_or_street" required placeholder="House No., Street, Purok" 
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm transition-all form-input-focus">
                     </div>
                  </div>
               </div>
               <div class="space-y-4 mt-10">
                  <div class="p-5 bg-white rounded-2xl border border-slate-200 flex items-start gap-4 transition-all hover:border-emerald-300 group">
                     <div class="flex items-center h-5">
                        <input id="voter" type="checkbox" name="is_registered_voter" value="1" 
                           class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                     </div>
                     <label for="voter" class="text-sm text-slate-700 font-medium leading-tight cursor-pointer group-hover:text-emerald-900 transition-colors">
                     I am a registered voter in this Barangay.
                     </label>
                  </div>
                  <div class="p-5 bg-white rounded-2xl border border-slate-200 flex items-start gap-4 transition-all hover:border-slate-400 group">
                     <div class="flex items-center h-5">
                        <input id="accuracy_terms" type="checkbox" name="accuracy_terms" required 
                           class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                     </div>
                     <label for="accuracy_terms" class="text-sm text-slate-700 font-medium leading-tight cursor-pointer">
                     I hereby certify that all information provided above is true and accurate to the best of my knowledge. <span class="text-red-500">*</span>
                     </label>
                  </div>
               </div>
               <button type="submit" class="w-full mt-10 bg-emerald-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all active:scale-[0.98]">
               Register Resident Account
               </button>
            </form>
         </div>
         <div class="mt-10 text-center pb-12">
            <p class="text-sm text-slate-400 font-medium">Already registered? 
               <a href="{{ route('login') }}" class="text-slate-900 font-bold hover:text-emerald-600 transition underline underline-offset-4 decoration-slate-200">Sign in here</a>
            </p>
         </div>
      </div>
      <script>
         function togglePassword() {
             const passwordInput = document.getElementById('password');
             const eyeIcon = document.getElementById('eye-icon');
             if (passwordInput.type === 'password') {
                 passwordInput.type = 'text';
                 eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`;
             } else {
                 passwordInput.type = 'password';
                 eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
             }
         }
      </script>
   </body>
</html>