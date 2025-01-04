<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-3xl font-semibold text-black mt-6">DETAIL PENAWARAN</h1>

        <!-- Tombol Tambah -->
        <div class="flex justify-between items-center mb-6 mt-6">
            <div class="space-x-4">
                <a href="{{ route('detail_penawaran.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Detail Penawaran
                </a>
            </div>
        </div>

        <!-- Tabel Detail Penawaran -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Nomor Penawaran</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Produk</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Jumlah</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detailPenawarans as $detail)
                        <tr class="hover:bg-gray-100 text-center">
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $detail->penawaran_id }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $detail->produk->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $detail->jumlah }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">
                                <!-- Tombol Edit -->
                                <a href="{{ route('detail_penawaran.edit', $detail->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('detail_penawaran.destroy', $detail->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus detail penawaran ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada detail penawaran tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $detailPenawarans->links() }}
        </div>
    </div>
</x-app-layout>
