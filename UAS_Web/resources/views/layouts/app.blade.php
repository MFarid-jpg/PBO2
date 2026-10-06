<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservation System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans text-slate-800">

    <div class="flex min-h-screen">
        <!-- SIDEBAR (UX: Navigasi Mudah) -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl">
            <div class="p-5 text-xl font-bold tracking-wider border-b border-slate-800 flex items-center gap-3">
                <i class="fa-solid fa-hotel text-indigo-400"></i>
                <span>StayEase</span>
            </div>
            <nav class="flex-1 px-4 space-y-2">
    <!-- Menu 1: Dashboard -->
    <a href="{{ route('dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-chart-pie w-5 text-center"></i>
        <span class="font-medium">Dashboard</span>
    </a>

    <!-- Menu 2: Manajemen Kamar -->
    <a href="{{ route('rooms.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('rooms.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-bed w-5 text-center"></i>
        <span class="font-medium">Manajemen Kamar</span>
    </a>

    <!-- Menu 3: Reservasi -->
    <a href="{{ route('reservations.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('reservations.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
        <i class="fa-solid fa-calendar-check w-5 text-center"></i>
        <span class="font-medium">Reservasi</span>
    </a>
</nav>
            <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
                &copy; 2026 Final Project Web
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col">
            <!-- NAVBAR ATAS -->
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center border-b border-slate-200">
                <h1 class="text-lg font-semibold text-slate-700">Dashboard Sistem Reservasi</h1>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                        A
                    </div>
                    <span class="text-sm font-medium text-slate-600">Admin</span>
                </div>
            </header>

            <!-- KONTEN DINAMIS -->
            <main class="flex-1 p-8">
                @if(session('success'))
                    <!-- Notifikasi Sukses Menarik (Good UX) -->
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                        <span class="text-emerald-800 font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>