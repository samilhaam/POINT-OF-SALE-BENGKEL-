<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem POS Bengkel Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex z-20 shadow-xl">
        <div>
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950">
                <i class="fa-solid fa-motorcycle text-blue-500 text-2xl mr-3"></i>
                <span class="font-bold text-lg text-white tracking-wide">BENGKEL-POS</span>
            </div>

            <nav class="p-4 space-y-1.5 overflow-y-auto">
                <p class="text-xs font-bold text-slate-500 uppercase px-3 mb-2 tracking-wider">Menu Utama</p>
                
                <a href="/" class="flex items-center px-4 py-3 rounded-xl font-medium bg-blue-600 text-white shadow-lg shadow-blue-600/20 transition-all duration-200">
                    <i class="fa-solid fa-cash-register w-6 text-lg"></i>
                    <span>POS Kasir</span>
                </a>

                <p class="text-xs font-bold text-slate-500 uppercase px-3 pt-4 mb-2 tracking-wider">Master Data</p>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl font-medium hover:bg-slate-800 hover:text-white transition group">
                    <i class="fa-solid fa-box w-6 text-lg text-slate-400 group-hover:text-blue-400"></i>
                    <span>Stok Sparepart</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl font-medium hover:bg-slate-800 hover:text-white transition group">
                    <i class="fa-solid fa-wrench w-6 text-lg text-slate-400 group-hover:text-blue-400"></i>
                    <span>Jasa Servis</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl font-medium hover:bg-slate-800 hover:text-white transition group">
                    <i class="fa-solid fa-user-gear w-6 text-lg text-slate-400 group-hover:text-blue-400"></i>
                    <span>Data Mekanik</span>
                </a>

                <p class="text-xs font-bold text-slate-500 uppercase px-3 pt-4 mb-2 tracking-wider">Laporan</p>

                <a href="#" class="flex items-center px-4 py-3 rounded-xl font-medium hover:bg-slate-800 hover:text-white transition group">
                    <i class="fa-solid fa-file-invoice-dollar w-6 text-lg text-slate-400 group-hover:text-blue-400"></i>
                    <span>Riwayat Penjualan</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-950/50 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">
                    K
                </div>
                <div>
                    <p class="text-sm font-semibold text-white leading-none">Kasir Toko</p>
                    <span class="text-xs text-slate-500">Petugas Aktif</span>
                </div>
            </div>
            <button class="text-slate-500 hover:text-red-400 p-1.5 rounded-lg transition">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
            </button>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10 shrink-0">
            <div class="flex items-center space-x-3">
                <button class="md:hidden text-gray-500 p-1 rounded hover:bg-gray-100">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h1 class="text-lg font-bold text-gray-800">Sistem Kasir Bengkel</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="text-sm font-medium text-gray-500 bg-gray-100 px-3 py-1.5 rounded-xl flex items-center">
                    <i class="fa-regular fa-clock mr-2 text-blue-500"></i>
                    <span>{{ date('d M Y') }}</span>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts
</body>
</html>