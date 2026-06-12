<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Bengkel Motor - Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">POS Bengkel Motor</h1>
            <span class="bg-blue-700 px-3 py-1 rounded text-sm font-semibold">Kasir Mode</span>
        </div>
    </nav>

    <div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">📦 Daftar Sparepart (Stok Tersedia)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($products as $product)
                        <div class="border p-4 rounded-lg hover:shadow-md transition bg-gray-50 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500 font-mono">{{ $product->sku }}</p>
                                <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-sm text-blue-600 font-bold">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-semibold">Stok: {{ $product->stock }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">🛠️ Daftar Jasa Servis</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($services as $service)
                        <div class="border p-4 rounded-lg hover:shadow-md transition bg-gray-50 flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $service->name }}</h3>
                                <p class="text-sm text-blue-600 font-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="space-y-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">👨‍🔧 Pilih Mekanik Bertugas</h2>
                <select class="w-full border p-2 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Mekanik --</option>
                    @foreach($mechanics as $mechanic)
                        <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between h-64 border-t-4 border-blue-600">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2">🛒 Ringkasan Nota</h2>
                    <p class="text-sm text-gray-500 italic mb-4">Keranjang belanja masih kosong...</p>
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between font-bold text-lg text-gray-800 mb-4">
                        <span>Total:</span>
                        <span>Rp 0</span>
                    </div>
                    <button class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed">
                        Bayar Sekarang
                    </button>
                </div>
            </div>

        </div>

    </div>

</body>
</html>