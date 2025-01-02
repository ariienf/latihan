<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-2xl font-semibold text-black mt-6">Edit Customer</h1>
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $customer->nama }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $customer->email }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ $customer->alamat }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                <input type="text" name="telepon" id="telepon" value="{{ $customer->telepon }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <button type="submit" class="bg-indigo-600 text-black px-4 py-2 rounded-md shadow-md hover:bg-indigo-700">
                Update Customer
            </button>
        </form>
    </div>
</x-app-layout>
