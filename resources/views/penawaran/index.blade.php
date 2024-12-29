<!-- resources/views/penawaran/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Penawaran</h1>

        <!-- Tampilkan pesan success atau error -->
        @if(session('success'))
            <div class="mb-4 text-green-600 bg-green-100 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('penawaran.create') }}" class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                Buat Penawaran Baru
            </a>
        </div>

        <!-- Daftar Penawaran -->
        <table class="min-w-full table-auto bg-white border border-gray-200 rounded-md shadow-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Customer</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penawarans as $penawaran)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-sm">{{ $penawaran->customer->nama }}</td>
                        <td class="px-6 py-3 text-sm">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $penawaran->status == 'Success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $penawaran->status }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-sm">{{ $penawaran->tanggal }}</td>
                        <td class="px-6 py-3 text-sm">
                            <a href="{{ route('penawaran.edit', $penawaran->id) }}" class="text-indigo-500 hover:text-indigo-700">Edit</a>
                            <!-- Add other actions as needed (e.g., delete) -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $penawarans->links() }}
        </div>
    </div>
</x-app-layout>
