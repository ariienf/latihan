<x-app-layout>
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold">Dashboard Overview</h1>
            <p class="text-gray-600">Welcome to your sales and product management system.</p>
        </div>

        <!-- Sales Overview Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Sales Overview</h2>
            <div class="flex items-center space-x-4">
                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Sales</h3>
                    <p class="text-2xl text-blue-500">{{ $totalUsers }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Sales Growth</span>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Products</h3>
                    <p class="text-2xl text-green-500">{{ $totalProducts }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Product Count</span>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Offers</h3>
                    <p class="text-2xl text-yellow-500">{{ $totalOffers }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-yellow-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Offers Made</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Sales and Products Chart</h2>
            <div class="bg-white shadow-md rounded-lg p-4">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Sales Section -->
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-4">Daftar Sales</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ $user->name }}
                            </div>
                        </td>
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
</div>

<!-- Products Section -->
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-4">Daftar Produk</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Harga</th>
                    <th class="border border-gray-300 px-4 py-2">Stok</th>
                    <th class="border border-gray-300 px-4 py-2">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $produk)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $produk->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ $produk->nama }}
                            </div>
                        </td>
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

<!-- Penawaran Section -->
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-4">Daftar Penawaran</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Customer</th>
                    <th class="border border-gray-300 px-4 py-2">Sales</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penawarans as $penawaran)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-yellow-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ $penawaran->customer->nama }}
                            </div>
                        </td>
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
</div>

<!-- Detail Penawaran Section -->
<div class="mb-8">
    <h2 class="text-2xl font-semibold mb-4">Detail Penawaran</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nomor Penawaran</th>
                    <th class="border border-gray-300 px-4 py-2">Produk</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detailPenawarans as $detail)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->penawaran_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex items-center">
                                <svg class="h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ $detail->produk->nama }}
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->jumlah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($detail-> subtotal, 0, ',', '.') }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sales', 'Products', 'Offers'],
                datasets: [{
                    label: 'Total',
                    data: [{{ $totalUsers }}, {{ $totalProducts }}, {{ $totalOffers }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>