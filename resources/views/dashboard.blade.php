<x-app-layout>
    
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold">Dashboard Overview</h1>
            <p class="text-gray-600">Welcome to your sales and product management system.</p>
        </div>
        <br>
        <!-- Sales and Products Section -->
        <div class="flex space-x-8 mb-8">
            <!-- Sales Section -->
            <div class="bg-white shadow-md rounded-lg p-6 w-full h-full">
                <h2 class="text-xl font-semibold mb-4">Daftar Sales</h2>
                <p>Total Sales: <span class="text-blue-500">{{ $totalUsers }}</span></p>
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Sales</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">No sales found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Products Section -->
            <div class="bg-white shadow-md rounded-lg p-6 w-full h-full">
                <h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Harga</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Stok</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produk)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $produk->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $produk->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $produk->stok }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $produk->kategori->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <!-- Penawaran and Detail Penawaran Section -->
        <div class="flex space-x-8">
            <!-- Penawaran Section -->
            <div class="bg-white shadow-md rounded-lg p-6 w-full h-full">
                <h2 class="text-xl font-semibold mb-4">Daftar Penawaran</h2>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Customer</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Sales</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penawarans as $penawaran)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->customer->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->status }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->tanggal->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">No offers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Detail Penawaran Section -->
            <div class="bg-white shadow-md rounded-lg p-6 w-full h-full">
                <h2 class="text-xl font-semibold mb-4">Detail Penawaran</h2>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nomor Penawaran</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Produk</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailPenawarans as $detail)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $detail->penawaran_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $detail->produk->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $detail->jumlah }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">No offer details found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
