<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-black shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">Selamat Datang!</h3>
                <p class="mt-2">Anda telah berhasil masuk. Lihat penawaran terbaru di bawah ini.</p>
            </div>

            <!-- Data Penawaran -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Data Penawaran</h3>
                <table class="w-full border-collapse overflow-hidden rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-blue-600 text-black">
                            <th class="px-4 py-3 text-left">Penawaran</th>
                            <th class="px-4 py-3 text-left">Sales</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">1</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Arie</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">23-12-2024</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">
                                <button 
                                    onclick="showDetails('detail-penawaran-1')" 
                                    class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">2</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Rizkan</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">24-12-2024</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">
                                <button 
                                    onclick="showDetails('detail-penawaran-2')" 
                                    class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">3</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Ria</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">25-12-2024</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">
                                <button 
                                    onclick="showDetails('detail-penawaran-2')" 
                                    class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Data Penawaran -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Detail Penawaran</h3>
                <table class="w-full border-collapse overflow-hidden rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-blue-600 text-black">
                            <th class="px-4 py-3 text-left">Detail</th>
                            <th class="px-4 py-3 text-left">Jumlah</th>
                            <th class="px-4 py-3 text-left">Subtotal</th>
                            <th class="px-4 py-3 text-center">Penawaran</th>
                            <th class="px-4 py-3 text-center">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">1</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">10 pcs</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">550.000</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">1</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Kartu Nama</td>
                        </tr>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">2</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">50 pcs</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">5.000.000</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">2</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Hard Box</td>
                        </tr>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">3</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">30 Lembar</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">750.000</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">3</td>
                            <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-700 text-center">Sticker Vinyl</td>
                        </tr>
                    </tbody>
                </table>
            </div>

    <script>
        function showDetails(id) {
            document.querySelectorAll('[id^="detail-penawaran-"]').forEach(el => el.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
        }
    </script>
</x-app-layout>
