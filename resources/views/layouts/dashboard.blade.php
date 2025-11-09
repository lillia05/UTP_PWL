{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#f3f6fa]">
    <nav class="bg-gradient-to-b from-[#202c46] to-[#1b2336] shadow-xl rounded-b-2xl px-24 py-5 flex items-center justify-between sticky top-0 z-40 w-full">
        <span class="text-white text-2xl font-bold tracking-wide">
            @if(auth()->user()->isBansus())
                Dashboard Bansus
            @else
                SiBookLab
            @endif
        </span>
        <div class="flex items-center gap-8">
            <span class="text-white text-lg font-medium">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-5 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-base font-semibold transition shadow-md">Logout</button>
            </form>
        </div>
    </nav>
    <main class="py-10 px-12">
        @yield('content')
    </main>
</body>
</html>