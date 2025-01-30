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
            <h2 class="text-xl font-semibold mb-4">Data Overview</h2>
            <div class="flex items-center space-x-4">
                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Detail Penawaran</h3>
                    <p class="text-2xl text-blue-500">{{ $totalDetail }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Detail Penawaran</span>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Penawaran</h3>
                    <p class="text-2xl text-yellow-500">{{ $totalOffers }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-yellow-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Penawaran</span>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-4 w-1/3">
                    <h3 class="font-semibold">Total Produk</h3>
                    <p class="text-2xl text-green-500">{{ $totalProducts }}</p>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="text-gray-600">Produk</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Chart for Penawaran -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-5">Penawaran</h2>
            <form method="GET" action="{{ url('/dashboard') }}">
                <select name="filter" onchange="this.form.submit()">
                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="7days" {{ $filter == '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="1month" {{ $filter == '1month' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                    <option value="3months" {{ $filter == '3months' ? 'selected' : '' }}>3 Bulan Terakhir</option>
                    <option value="1year" {{ $filter == '1year' ? 'selected' : '' }}>1 Tahun Terakhir</option>
                </select>
            </form>
            <div class="bg-white shadow-md rounded-lg p-4">
                <canvas id="penawaranChart" height="100"></canvas>
            </div>
        </div>
        <!-- Tabel untuk Menampilkan Detail Penawaran -->
        <div class="mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-center">
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nomor Penawaran</th>
                            <th class="border border-gray-300 px-4 py-2">Customer</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filteredPenawarans as $penawaran)
                            <tr class="hover:bg-gray-100 text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->customer->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->tanggal->format('d-m-Y') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $penawaran->status }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('penawaran.detail', $penawaran->id) }}" class="text-blue-500 hover:underline">Check</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">Tidak ada data penawaran untuk filter yang dipilih.</td>
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
                            <th class="border border-gray-300 px-4 py-2">No</th>
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
    
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Grafik untuk Jumlah Penawaran berdasarkan tanggal
            const ctxPenawaran = document.getElementById('penawaranChart').getContext('2d');
            const penawaranData = @json($penawaranData);
        
            const labels = Object.keys(penawaranData);
            const data = Object.values(penawaranData);
        
            const penawaranChart = new Chart(ctxPenawaran, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Penawaran',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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