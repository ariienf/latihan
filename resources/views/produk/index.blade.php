<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="mt-6 text-3xl font-semibold text-black">DAFTAR PRODUK</h1>

        <!-- Tombol Tambah -->
        <div class="flex justify-between items-center mb-6 mt-6">
            <div class="space-x-4">
                <a href="{{ route('produks.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Produk
                </a>
                <a href="{{ route('kategoris.index') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Kategori
                </a>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Harga</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Stok</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr class="hover:bg-gray-100 text-center">
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $produk->id }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $produk->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $produk->stok }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $produk->kategori->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">
                                <a href="{{ route('produks.edit', $produk) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('produks.delete', $produk) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada produk tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $produks->links() }}
        </div>
    </div>
</x-app-layout>
