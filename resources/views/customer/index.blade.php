<x-app-layout>
    <div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold text-black mb-6 mt-6">DAFTAR CUSTOMER</h1>

        @if (session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Alamat</th>
                        <th class="px-6 py-3 text-left">Telepon</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-3">{{ $customer->id }}</td>
                            <td class="px-6 py-3">{{ $customer->nama }}</td>
                            <td class="px-6 py-3">{{ $customer->email }}</td>
                            <td class="px-6 py-3">{{ $customer->alamat }}</td>
                            <td class="px-6 py-3">{{ $customer->telepon }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="text-indigo-500 hover:underline">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
