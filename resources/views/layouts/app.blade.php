<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPUS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">
    <header class="bg-white border-b border-slate-200 sticky top-0 z-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 font-bold text-slate-900 tracking-tight">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-indigo-600 text-white text-sm font-extrabold">
                    SP
                </span>
                <span>SIPUS <span class="hidden sm:inline font-normal text-slate-400 text-xs ml-1">Perpustakaan</span></span>
            </a>

            <nav class="flex items-center gap-1 sm:gap-2 text-sm font-medium">
                <a href="{{ route('dashboard') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    Dashboard
                </a>
                <a href="{{ route('buku.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('buku.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    Buku
                </a>
                <a href="{{ route('anggota.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('anggota.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    Anggota
                </a>
                <a href="{{ route('peminjaman.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('peminjaman.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    Peminjaman
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-800 flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-sm text-rose-800">
                <p class="font-semibold mb-1">Periksa kembali inputan kamu:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white py-4 text-center text-xs text-slate-400">
       SIPUS - Si Perpustakaan Gen Z
    </footer>
</body>
</html>