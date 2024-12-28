<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' }}</h1>
        <form action="{{ isset($kategori) ? route('kategoris.update', $kategori) : route('kategoris.store') }}" method="POST">
            @csrf
            @if(isset($kategori))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $kategori->nama ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            <button type="submit" class="bg-indigo-600 text-black px-4 py-2 rounded-md hover:bg-indigo-700">
                {{ isset($kategori) ? 'Update' : 'Simpan' }}
            </button>
        </form>
    </div>
</x-app-layout>
