<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.R.I.M. | Official Barangay Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-[#fcfcfc] text-slate-900 antialiased">

    <nav class="sticky top-0 z-50 border-b border-slate-200 glass-effect">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-slate-900 flex items-center justify-center rounded shadow-sm">
                    <span class="text-white font-bold text-xl leading-none">B</span>
                </div>
                <div>
                    <h1 class="text-sm font-bold uppercase tracking-widest text-slate-900">B.R.I.M.</h1>
                    <p class="text-[10px] text-slate-500 font-medium uppercase tracking-tighter">East Calaguiman
                        Official</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm font-semibold text-white bg-emerald-600 px-5 py-2.5 rounded hover:bg-emerald-700 transition shadow-sm">Portal
                        Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Sign
                        In</a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="relative overflow-hidden pt-16 pb-24 border-b border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 items-center gap-16">
            <div>
                <span
                    class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-6">
                    Digital Government Initiative
                </span>
                <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-8">
                    Modern Solutions for <br>
                    <span class="text-emerald-600">Resilient Communities.</span>
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-10 max-w-lg">
                    The Barangay Resident Information Management system provides a centralized platform for secure
                    document requests, incident reporting, and transparent local governance.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-emerald-600 text-white px-8 py-4 rounded font-bold hover:bg-emerald-700 transition-all flex items-center gap-2">
                        Register as Resident
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative bg-white border border-slate-200 rounded-2xl p-6 shadow-2xl overflow-hidden group">
                <div class="flex items-center justify-between mb-8 border-b border-slate-50 pb-4">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-slate-200"></div>
                        <div class="w-3 h-3 rounded-full bg-slate-200"></div>
                        <div class="w-3 h-3 rounded-full bg-slate-200"></div>
                    </div>
                    <div
                        class="px-3 py-1 bg-emerald-50 rounded text-[10px] font-bold text-emerald-600 uppercase tracking-widest">
                        Resident Session: Active
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] uppercase font-bold text-slate-400 mb-1">Documents</p>
                        <p class="text-2xl font-bold text-slate-900 leading-none">02</p>
                        <p class="text-[10px] text-emerald-600 font-medium mt-1">Ready for pickup</p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] uppercase font-bold text-slate-400 mb-1">Reports</p>
                        <p class="text-2xl font-bold text-slate-900 leading-none">00</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-1">No active alerts</p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-900 border border-slate-900 shadow-lg shadow-slate-200">
                        <p class="text-[10px] uppercase font-bold text-slate-300 mb-1">Next Event</p>
                        <p class="text-xl font-bold text-white leading-tight">May 12</p>
                        <p class="text-[10px] text-emerald-400 font-medium mt-1">Health Drive</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <p class="text-xs font-bold text-slate-800 px-1">Recent Activity</p>
                    <div
                        class="bg-white border border-slate-100 rounded-lg p-3 flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900 leading-none">Barangay Clearance</p>
                                <p class="text-[10px] text-slate-400 mt-1">Application Approved</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-slate-400">2h ago</span>
                    </div>

                    <div
                        class="bg-white border border-slate-100 rounded-lg p-3 flex items-center justify-between shadow-sm opacity-60">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-slate-100 flex items-center justify-center text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900 leading-none">Streetlight Repair</p>
                                <p class="text-[10px] text-slate-400 mt-1">Report Received</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-mono text-slate-400">Yesterday</span>
                    </div>
                </div>

                <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-400/10 blur-3xl rounded-full"></div>
            </div>
        </div>
    </header>

    <section id="services" class="py-24 max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <h3 class="text-3xl font-bold text-slate-900 mb-4">Resident Services</h3>
                <p class="text-slate-500">Official digital channels for administrative and emergency services.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div
                class="group p-8 bg-white border border-slate-200 rounded-lg hover:border-emerald-500 transition-all cursor-default">
                <div
                    class="w-12 h-12 bg-slate-50 rounded flex items-center justify-center mb-6 group-hover:bg-emerald-50 transition">
                    <svg class="w-6 h-6 text-slate-900 group-hover:text-emerald-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-3">Document Processing</h4>
                <p class="text-sm text-slate-500 leading-relaxed">Securely request Barangay Clearance, Certificates of
                    Residency, and Indigency without the need for physical queues.</p>
            </div>

            <div
                class="group p-8 bg-white border border-slate-200 rounded-lg hover:border-emerald-500 transition-all cursor-default">
                <div
                    class="w-12 h-12 bg-slate-50 rounded flex items-center justify-center mb-6 group-hover:bg-emerald-50 transition">
                    <svg class="w-6 h-6 text-slate-900 group-hover:text-emerald-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-3">Public Safety Reports</h4>
                <p class="text-sm text-slate-500 leading-relaxed">Direct digital line to the Barangay Tanod for
                    incident reporting and emergency assistance within the jurisdiction.</p>
            </div>

            <div
                class="group p-8 bg-white border border-slate-200 rounded-lg hover:border-emerald-500 transition-all cursor-default">
                <div
                    class="w-12 h-12 bg-slate-50 rounded flex items-center justify-center mb-6 group-hover:bg-emerald-50 transition">
                    <svg class="w-6 h-6 text-slate-900 group-hover:text-emerald-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-3">Community Programs</h4>
                <p class="text-sm text-slate-500 leading-relaxed">Official registry for health drives, livelihood
                    seminars, and local assemblies. Stay informed on town hall schedules.</p>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div>
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded bg-slate-200 text-slate-700 text-[10px] font-bold uppercase tracking-widest mb-6">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    For Developers & Agencies
                </div>
                <h3 class="text-3xl font-bold text-slate-900 mb-6">Consume Our Data API</h3>
                <p class="text-slate-600 leading-relaxed mb-8">
                    B.R.I.M. provides a secure, RESTful API for authorized external agencies (such as City Health
                    Offices or DSWD) to securely fetch validated resident demographics, improving inter-agency
                    coordination and data accuracy.
                </p>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/docs') }}"
                        class="bg-slate-900 text-white px-6 py-3 rounded font-semibold hover:bg-slate-800 transition shadow-sm flex items-center gap-2">
                        View API Documentation
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-[#1e1e1e] rounded-xl overflow-hidden shadow-2xl border border-slate-800">
                <div class="flex items-center px-4 py-3 bg-[#2d2d2d] border-b border-[#3d3d3d]">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <span class="ml-4 text-[10px] text-slate-400 font-mono">GET /api/residents</span>
                </div>
                <div class="p-6 overflow-x-auto text-sm font-mono leading-loose text-slate-300">
                    <span class="text-blue-400">fetch</span>(<span
                        class="text-emerald-400">'https://brim.gov.ph/api/residents'</span>, {<br>
                    &nbsp;&nbsp;<span class="text-sky-300">method</span>: <span
                        class="text-emerald-400">'GET'</span>,<br>
                    &nbsp;&nbsp;<span class="text-sky-300">headers</span>: {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-emerald-400">'Authorization'</span>: <span
                        class="text-emerald-400">'Bearer {YOUR_API_TOKEN}'</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-emerald-400">'Accept'</span>: <span
                        class="text-emerald-400">'application/json'</span><br>
                    &nbsp;&nbsp;}<br>
                    })<br>
                    .<span class="text-blue-400">then</span>(response <span class="text-purple-400">=&gt;</span>
                    response.<span class="text-blue-400">json</span>())<br>
                    .<span class="text-blue-400">then</span>(data <span class="text-purple-400">=&gt;</span> <span
                        class="text-sky-300">console</span>.<span class="text-blue-400">log</span>(data));
                </div>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 text-white mb-6">
                        <div class="w-8 h-8 bg-emerald-600 flex items-center justify-center rounded">
                            <span class="font-bold">B</span>
                        </div>
                        <span class="font-bold tracking-widest uppercase">B.R.I.M.</span>
                    </div>
                    <p class="max-w-xs text-sm leading-relaxed">
                        The official digital infrastructure for Barangay Resident Information Management. Dedicated to
                        efficient and transparent community service.
                    </p>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">Quick Links</h5>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Citizen Charter</a></li>
                        <li><a href="#" class="hover:text-white transition">Admin Portal</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-bold mb-4">Contact</h5>
                    <ul class="text-sm space-y-2 font-mono">
                        <li>East Calaguiman, Samal</li>
                        <li>Bataan, PH</li>
                        <li>support@brim.gov.ph</li>
                    </ul>
                </div>
            </div>
            <div
                class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between gap-4 text-[10px] uppercase font-bold tracking-widest text-slate-600">
                <p>&copy; {{ date('Y') }} B.R.I.M. Barangay Management System</p>
                <p>Designed for East Calaguiman</p>
            </div>
        </div>
    </footer>

</body>

</html>
