<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>B.R.I.M. | Resident Registration</title>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <script src="https://cdn.tailwindcss.com"></script>
      <style>
         body { font-family: 'Inter', sans-serif; background-color: #ffffff; }
         .dot-grid {
         background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
         background-size: 24px 24px;
         }
         select {
         appearance: none;
         background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
         background-repeat: no-repeat;
         background-position: right 1rem center;
         background-size: 1em;
         }
      </style>
   </head>
   <body class="dot-grid min-h-screen flex flex-col items-center justify-center p-6 antialiased">
      <div class="fixed top-8 left-8">
         <a href="/" class="flex items-center gap-2 text-slate-400 hover:text-slate-900 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-xs font-bold uppercase tracking-widest">Back to Homepage</span>
         </a>
      </div>
      <div class="w-full max-w-3xl my-12">
         <div class="mb-8 text-center">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-slate-50 border border-slate-100 rounded-2xl mb-6">
               <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
               <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Resident Enrollment</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">Create Official Account.</h1>
            <p class="text-slate-500 text-sm mt-2">Fill in your details to register in the Barangay Information System.</p>
         </div>
         <div class="bg-white border border-slate-200 rounded-[2rem] p-8 md:p-12 shadow-sm">
            <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="mb-10">
                  <div class="flex items-center gap-4 mb-6">
                     <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">01</span>
                     <h3 class="font-bold text-slate-800 uppercase tracking-wider text-sm">Login Credentials</h3>
                     <div class="flex-1 h-px bg-slate-100"></div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                     <div class="space-y-1">
                        <x-input-label for="email" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Email Address')" />
                        <x-text-input id="email" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="email" name="email" required placeholder="name@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                     </div>
                     <div class="space-y-1">
                        <x-input-label for="password" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Password')" />
                        <x-text-input id="password" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                     </div>
                  </div>
               </div>
               <div class="mb-10">
                  <div class="flex items-center gap-4 mb-8">
                     <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">02</span>
                     <h3 class="font-bold text-slate-800 uppercase tracking-wider text-sm">Official Resident Profile</h3>
                     <div class="flex-1 h-px bg-slate-100"></div>
                  </div>
                  <div class="grid grid-cols-12 gap-6">
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="first_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('First Name')" />
                        <x-text-input id="first_name" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="first_name" required />
                     </div>
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="middle_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Middle Name')" />
                        <x-text-input id="middle_name" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="middle_name" />
                     </div>
                  </div>
                  <div class="grid grid-cols-12 gap-6 mt-6">
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="last_name" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Last Name')" />
                        <x-text-input id="last_name" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="last_name" required />
                     </div>
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="suffix" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Suffix (Jr, III)')" />
                        <x-text-input id="suffix" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="suffix" />
                     </div>
                  </div>
                  <div class="grid grid-cols-12 gap-6 mt-6">
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="date_of_birth" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Date of Birth')" />
                        <x-text-input id="date_of_birth" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="date" name="date_of_birth" required />
                     </div>
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="gender" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Gender')" />
                        <select name="gender" class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all appearance-none">
                           <option value="Male">Male</option>
                           <option value="Female">Female</option>
                           <option value="Other">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="grid grid-cols-12 gap-6 mt-6">
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="civil_status" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Civil Status')" />
                        <select name="civil_status" class="w-full px-4 py-3.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all appearance-none">
                           <option value="Single">Single</option>
                           <option value="Married">Married</option>
                           <option value="Widowed">Widowed</option>
                           <option value="Separated">Separated</option>
                        </select>
                     </div>
                     <div class="col-span-12 md:col-span-6 space-y-1">
    <x-input-label for="contact_number" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Contact Number')" />
    <x-text-input 
        id="contact_number" 
        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" 
        type="text" 
        name="contact_number" 
        placeholder="09123456789"
        maxlength="11"
        pattern="\d{11}"
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
        required 
    />
    <x-input-error :messages="$errors->get('contact_number')" class="mt-1" />
</div>
                  </div>
                  <div class="grid grid-cols-12 gap-6 mt-6">
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="occupation" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Occupation')" />
                        <x-text-input id="occupation" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="occupation" placeholder="e.g. Employee, Student" />
                     </div>
                     <div class="col-span-12 md:col-span-6 space-y-1">
                        <x-input-label for="purok_or_street" class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1" :value="__('Purok / Street Address')" />
                        <x-text-input id="purok_or_street" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all" type="text" name="purok_or_street" required placeholder="House No., Street, Purok" />
                     </div>
                  </div>
               </div>
               <div class="mt-8 p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center">
                  <input id="voter" type="checkbox" name="is_registered_voter" value="1" class="w-5 h-5 rounded border-emerald-300 text-emerald-600 focus:ring-emerald-500 transition cursor-pointer">
                  <label for="voter" class="ms-3 text-sm text-emerald-800 font-medium cursor-pointer">
                  {{ __('I am a registered voter in this Barangay') }}
                  </label>
               </div>
         </div>
         <br>
         <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 transition-all active:scale-[0.98]">
         Register Resident Account
         </button>
         </form>
      </div>
      <div class="mt-8 text-center pb-12">
         <p class="text-sm text-slate-400 font-medium">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-slate-900 font-bold hover:text-emerald-600 transition">Sign in here</a>
         </p>
      </div>
      </div>
   </body>
</html>