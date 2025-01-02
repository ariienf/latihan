<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="mt-6 text-3xl font-semibold text-gray-800">DAFTAR KATEGORI</h1>
        <div class="flex justify-between items-center mb-6 mt-6">
            <div class="space-x-4">
                <a href="{{ route('kategoris.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Kategori
                </a>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($kategoris as $kategori)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $kategori->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $kategori->nama }}</td>
                        <td class="px-6 py-4 text-right text-sm">
                            <a href="{{ route('kategoris.edit', $kategori) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('kategoris.delete', $kategori) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
