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
        <table class="min-w-full table-auto bg-white border border-gray-200 rounded-md shadow-sm mt-4">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Customer</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Sales</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penawarans as $penawaran)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm">{{ $penawaran->id }}</td>
                        <td class="px-6 py-3 text-sm">{{ $penawaran->customer->nama }}</td>
                        <td class="px-6 py-3 text-sm">{{ $penawaran->user->name }}</td>
                        <td class="px-6 py-3 text-sm">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($penawaran->status == 'On Progress')
                                    bg-red-100 text-red-800
                                @elseif($penawaran->status == 'Success')
                                    bg-green-100 text-green-800
                                @endif">
                                {{ $penawaran->status }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-sm">{{ $penawaran->tanggal->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <!-- Tombol Edit -->
                            <a href="{{ route('penawaran.edit', $penawaran) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('penawaran.delete', $penawaran) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus Penawaran ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $penawarans->links() }}
        </div>

        <!-- Daftar Customer -->
        <h2 class="mt-10 text-2xl font-semibold text-black">Daftar Customer</h2>
        <table class="min-w-full table-auto bg-white border border-gray-200 rounded-md shadow-sm mt-4">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Alamat</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-sm">{{ $customer->nama }}</td>
                        <td class="px-6 py-3 text-sm">{{ $customer->email }}</td>
                        <td class="px-6 py-3 text-sm">{{ $customer->alamat }}</td>
                        <td class="px-6 py-3 text-sm">{{ $customer->telepon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <!-- Tombol Edit -->
                            <a href="{{ route('customers.edit', $customer->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('customers.delete', $customer->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus customer ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <!-- Pagination -->
        <div class="mt-6">
            {{ $customers->links() }}
        </div>

</x-app-layout>
