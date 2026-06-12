<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 max-w-[1600px] mx-auto">
    
    <div class="xl:col-span-3">
        @if (session()->has('error'))
            <div class="bg-red-50 text-red-700 p-4 rounded-2xl mb-2 font-semibold border border-red-200 flex items-center shadow-sm animate-pulse">
                <i class="fa-solid fa-circle-exclamation mr-3 text-lg"></i>
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-2xl mb-2 font-semibold border border-emerald-200 flex items-center shadow-sm">
                <i class="fa-solid fa-circle-check mr-3 text-lg text-emerald-500"></i>
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="xl:col-span-2 space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                <h2 class="text-md font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-box-open mr-2 text-blue-500"></i> Daftar Sparepart / Suku Cadang
                </h2>
                <span class="text-xs bg-blue-50 text-blue-600 font-semibold px-2.5 py-1 rounded-full">Tersedia</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($products as $product)
                    <div wire:key="prod-{{ $product->id }}" 
                         wire:click="addToCart({{ $product->id }}, 'product')" 
                         class="border border-gray-200 p-4 rounded-xl hover:shadow-md hover:border-blue-500 cursor-pointer bg-white transition-all duration-200 active:scale-[0.98] group flex flex-col justify-between min-h-[100px]">
                        <div>
                            <span class="text-[10px] text-gray-400 font-mono bg-gray-50 px-2 py-0.5 rounded border border-gray-100">{{ $product->sku }}</span>
                            <h3 class="font-semibold text-gray-800 mt-1 text-sm group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-2 border-t border-gray-50">
                            <p class="text-blue-600 font-bold text-sm">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                            <span class="text-xs text-gray-500">Stok: <b class="{{ $product->stock < 5 ? 'text-red-500' : 'text-slate-700' }}">{{ $product->stock }}</b></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                <h2 class="text-md font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-screwdriver-wrench mr-2 text-blue-500"></i> Daftar Jasa Servis Motor
                </h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($services as $service)
                    <div wire:key="serv-{{ $service->id }}" 
                         wire:click="addToCart({{ $service->id }}, 'service')" 
                         class="border border-gray-200 p-4 rounded-xl hover:shadow-md hover:border-blue-500 cursor-pointer bg-white transition-all duration-200 active:scale-[0.98] group flex flex-col justify-between">
                        <h3 class="font-semibold text-gray-800 text-sm group-hover:text-blue-600 transition">{{ $service->name }}</h3>
                        <div class="mt-3 pt-2 border-t border-gray-50 flex justify-between items-center">
                            <p class="text-blue-600 font-bold text-sm">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                            <i class="fa-solid fa-plus text-xs text-gray-300 group-hover:text-blue-500 transition"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="space-y-6">
        
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-sm font-bold text-gray-800 mb-3 flex items-center">
                <i class="fa-solid fa-user-nut mr-2 text-blue-500"></i> Mekanik yang Bertugas
            </h2>
            <select wire:model="mechanic_id" class="w-full border border-gray-200 p-2.5 rounded-xl bg-gray-50 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                <option value="">-- Pilih Mekanik Bertugas --</option>
                @foreach($mechanics as $mechanic)
                    <option value="{{ $mechanic->id }}">👨‍🔧 {{ $mechanic->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col min-h-[400px] relative border-t-4 border-blue-600">
            
            <div wire:loading class="absolute inset-0 bg-white/70 backdrop-blur-sm z-10 flex flex-col items-center justify-center font-semibold text-blue-600 rounded-2xl">
                <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                Memproses Nota...
            </div>

            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h2 class="text-md font-bold text-gray-800 flex items-center">
                    <i class="fa-solid fa-receipt mr-2 text-blue-500"></i> Ringkasan Nota
                </h2>
            </div>
            
            <div class="flex-grow overflow-y-auto pr-1 max-h-[250px] space-y-3">
                @forelse($cart as $index => $item)
                    <div wire:key="cart-{{ $index }}" class="flex justify-between items-start text-sm bg-gray-50 p-3 rounded-xl border border-gray-100 group">
                        <div class="space-y-0.5">
                            <p class="font-semibold text-gray-800 text-xs">{{ $item['name'] }}</p>
                            <p class="text-gray-500 text-[11px]">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center space-x-3 pl-2">
                            <span class="font-bold text-gray-800 text-xs">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                            <button wire:click="removeFromCart({{ $index }})" class="text-gray-300 hover:text-red-500 transition-colors">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <i class="fa-solid fa-basket-shopping text-3xl mb-2 text-gray-200"></i>
                        <p class="text-xs italic">Belum ada item terpilih</p>
                    </div>
                @endforelse
            </div>
            
            <div class="border-t border-gray-100 pt-4 mt-4">
                <div class="flex justify-between font-bold text-gray-800 text-base mb-4">
                    <span>Total Tagihan:</span>
                    <span class="text-blue-600 text-lg">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                </div>
                
                <button wire:click="processPayment" 
                        @if(empty($cart)) disabled @endif 
                        class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed shadow-lg shadow-blue-600/10 transition duration-200 flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>Bayar Sekarang</span>
                </button>
            </div>
        </div>
    </div>

    @if($showReceiptModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4 animate-fade-in">
            <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full overflow-hidden border border-gray-100 flex flex-col transform scale-100 transition-all">
                
                <div class="bg-emerald-50 p-6 flex flex-col items-center justify-center border-b border-emerald-100">
                    <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xl shadow-md mb-2">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <h3 class="text-lg font-bold text-emerald-800">Pembayaran Berhasil!</h3>
                    <p class="text-xs text-emerald-600/80 font-medium">Transaksi telah tercatat dan stok terpotong</p>
                </div>

                <div class="p-6 space-y-4 bg-gray-50/50 flex-grow text-sm">
                    <div class="flex justify-between text-xs text-gray-500 font-medium border-b pb-2 border-dashed border-gray-200">
                        <div>
                            <p>No. Nota: <span class="font-mono text-gray-800 font-bold">{{ $receiptData['invoice_number'] }}</span></p>
                            <p>Mekanik: <span class="text-gray-800 font-semibold">{{ $receiptData['mechanic_name'] }}</span></p>
                        </div>
                        <div class="text-right">
                            <p>{{ $receiptData['date'] }}</p>
                            <p>Kasir: Toko Utama</p>
                        </div>
                    </div>

                    <div class="space-y-2.5 max-h-[180px] overflow-y-auto py-1">
                        @foreach($receiptData['items'] as $item)
                            <div class="flex justify-between items-start text-xs">
                                <div class="max-w-[70%]">
                                    <p class="font-semibold text-gray-800 leading-tight">{{ $item['name'] }}</p>
                                    <p class="text-gray-400 text-[10px]">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <span class="font-bold text-gray-700">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total Pembayaran :</span>
                        <span class="text-base font-extrabold text-blue-600">Rp {{ number_format($receiptData['total'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="p-4 bg-white border-t border-gray-100 grid grid-cols-2 gap-3 shrink-0">
                    <button onclick="window.print()" class="flex items-center justify-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-4 rounded-xl transition duration-150 text-sm">
                        <i class="fa-solid fa-print"></i>
                        <span>Cetak Struk</span>
                    </button>
                    <button wire:click="closeReceiptModal" class="flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-md shadow-blue-600/10 transition duration-150 text-sm">
                        <span>Transaksi Baru</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>