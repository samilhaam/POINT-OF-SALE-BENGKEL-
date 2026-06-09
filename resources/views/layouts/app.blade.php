<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir - SANDI JAYA MOTOR</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk Ikon Menu yang Lebih Premium -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        /* Style untuk Sidebar Kiri */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212529; /* Gelap elegan */
            z-index: 100;
            padding-top: 20px;
        }
        /* Style untuk Area Konten Utama di Kanan */
        .main-content {
            margin-left: 280px; /* Jaraknya sama dengan lebar sidebar */
            padding: 30px;
            min-height: 100vh;
        }
        /* Desain Tombol Menu */
        .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            padding: 12px 20px !important;
            margin: 5px 15px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        /* Efek Hover (Saat Disentuh Mouse) */
        .nav-link:hover {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        /* Status Aktif Sesuai Halaman yang Dibuka */
        .nav-link.active {
            color: #fff !important;
            background-color: #198754 !important; /* Warna hijau sukses */
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
        }
        .sidebar-brand {
            font-size: 1.3rem;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- SIDEBAR NAVIGASI (KIRI) -->
        <div class="sidebar d-flex flex-column flex-shrink-0 text-white shadow">
            <div class="sidebar-brand text-center col-12">
                <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fw-bold">
                     SANDI JAYA MOTOR
                </a>
            </div>
            
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Menu Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge me-3"></i>Dashboard Utama
                    </a>
                </li>
                <!-- Menu Stok Barang -->
                <li>
                    <a href="{{ route('barang.index') }}" class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-boxes-stacked me-3"></i>Stok Barang
                    </a>
                </li>
                <!-- Menu Kasir Transaksi -->
                <li>
                    <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaksi.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-cash-register me-3"></i>Kasir Transaksi
                    </a>
                </li>
                <!-- Menu Laporan Pendapatan -->
                <li>
                    <a href="{{ route('transaksi.laporan') }}" class="nav-link {{ request()->routeIs('transaksi.laporan') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line me-3"></i>Laporan Pendapatan
                    </a>
                </li>
            </ul>
            
            <!-- Footer Kecil Sidebar -->
            <div class="p-3 text-center border-top border-secondary text-muted small">
                Sandi JAYA Motor &copy; 2026
            </div>
        </div>

        <!-- AREA KONTEN UTAMA (KANAN) -->
        <div class="main-content flex-grow-1">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>