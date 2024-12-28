<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="mt-6 text-2xl font-semibold text-gray-800">Daftar Produk</h1>
            <div class="space-x-4">
                <a href="{{ route('produks.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Produk
                </a>
                <a href="{{ route('kategoris.index') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Kategori
                </a>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($produks as $produk)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produk->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->harga }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->stok }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $produk->kategori->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('produks.edit', $produk) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('produks.destroy', $produk) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
