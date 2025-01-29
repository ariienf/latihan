<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="mt-6 text-3xl font-semibold text-black">PENAWARAN</h1>

        <!-- Tampilkan pesan success atau error -->
        @if(session('success'))
            <div class="mb-4 text-green-600 bg-green-100 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Tambah -->
        <div class="flex justify-between items-center mb-6 mt-6">
            <div class="space-x-4">
                <a href="{{ route('customers.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Customer
                </a>
                <a href="{{ route('penawaran.create') }}" class="mt-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:from-pink-500 hover:to-indigo-500 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-300">
                    Tambah Penawaran
                </a>
            </div>
        </div>

        <!-- Daftar Penawaran -->
        <h2 class="mt-8 text-2xl font-semibold text-black">Daftar Penawaran</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Customer</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Sales</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penawarans as $penawaran)
                        <tr class="hover:bg-gray-100 text-center">
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $penawaran->customer->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $penawaran->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($penawaran->status == 'On Progress') bg-red-100 text-red-800 
                                    @elseif($penawaran->status == 'Success') bg-green-100 text-green-800 
                                    @endif">
                                    {{ $penawaran->status }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $penawaran->tanggal->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">
                                <a href="{{ route('penawaran.edit', $penawaran) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('penawaran.delete', $penawaran) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus Penawaran ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada penawaran tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br>
        <!-- Daftar Customer -->
        <h2 class="mt-10 text-2xl font-semibold text-black">Daftar Customer</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Alamat</th>
                        <th class="border border-gray-300 px-4 py-2 text-sm font-medium">Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-100 text-center">
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $customer->nama }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $customer->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $customer->alamat }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">{{ $customer->telepon }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-sm">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('customers.delete', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus customer ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada customer tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $customers->links() }}
        </div>
    </div>
</x-app-layout>
