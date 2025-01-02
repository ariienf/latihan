<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mt-6">Detail Penawaran</h2>

        <!-- Tombol Tambah -->
        <div class="flex justify-between items-center mb-6 mt-6">
            <div class="space-x-4">
                <a href="{{ route('detail_penawaran.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Detail Penawaran
                </a>
            </div>
        </div>

        <table class="min-w-full table-auto bg-white border border-gray-200 rounded-md shadow-sm mt-4">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Penawaran</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Produk</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Jumlah</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPenawarans as $detail)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-sm">{{ $detail->penawaran_id }}</td>
                        <td class="px-6 py-3 text-sm">{{ $detail->produk->nama }}</td>
                        <td class="px-6 py-3 text-sm">{{ $detail->jumlah }}</td>
                        <td class="px-6 py-3 text-sm">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm">
                            <a href="{{ route('detail_penawaran.edit', $detail->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>

                            <form action="{{ route('detail_penawaran.destroy', $detail->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus detail penawaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $detailPenawarans->links() }}
        </div>
    </div>
</x-app-layout>
