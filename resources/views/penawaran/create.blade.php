<x-app-layout>
<div class="mt-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <form action="{{ route('penawaran.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        
    <!-- Customer Information -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Data Customer</h2>

        <label for="customer_nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="customer_nama" id="customer_nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>

    <div class="mb-6">
        <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="customer_email" id="customer_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>

    <div class="mb-6">
        <label for="customer_alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
        <input type="text" name="customer_alamat" id="customer_alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>

    <div class="mb-6">
        <label for="customer_telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
        <input type="text" name="customer_telepon" id="customer_telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>

    <!-- Status & Date -->
    <div class="mb-6">
        <label for="status" class="block text-sm font-medium text-gray-700">Status Penawaran</label>
        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="On Progress">On Progress</option>
            <option value="Success">Success</option>
        </select>
    </div>

    <div class="mb-6">
        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Penawaran</label>
        <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    </div>

    <!-- User Selection -->
    <div class="mb-6">
        <label for="user_id" class="block text-sm font-medium text-gray-700">Sales</label>
        <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Produk Selection -->
    <div class="mb-6">
        <label for="produk_ids" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
        <div id="produk-container">
            <div class="produk-item mb-4">
                <select name="produk_ids[]" class="produk-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Produk</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" data-stok="{{ $produk->stok }}">{{ $produk->nama }} - Rp{{ number_format($produk->harga, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <br>
                <div class="mb-4">
                    <label for="jumlahs" class="block text-sm font-medium text-gray-700">Jumlah Produk</label>
                    <input type="number" name="jumlahs[]" id="jumlahs" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="1" required>
                </div>
            </div>
        </div>

        <!-- Add more product button -->
        <button type="button" id="add-produk-btn" class="text-indigo-500 hover:text-indigo-700 mt-2 flex items-center">
            <span class="mr-2">Tambah Produk</span>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" class="bg-indigo-500 text-black font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-300">
            Simpan Penawaran
        </button>
    </div>

<!-- JavaScript to Add Product Select Inputs -->
<script>
    // Handle product selection and update quantity input based on stock
    document.getElementById('produk-container').addEventListener('change', function(event) {
        if (event.target.classList.contains('produk-select')) {
            let selectElement = event.target;
            let stok = selectElement.selectedOptions[0].getAttribute('data-stok');
            let quantityInput = selectElement.closest('.produk-item').querySelector('input[name="jumlahs[]"]');
            
            // Set max value for quantity based on stock
            quantityInput.setAttribute('max', stok);
        }
    });

    // Add more products dynamically
    document.getElementById('add-produk-btn').addEventListener('click', function() {
        let produkContainer = document.getElementById('produk-container');
        let firstProdukItem = produkContainer.querySelector('.produk-item');
        let clonedProdukItem = firstProdukItem.cloneNode(true);
        
        // Reset the quantity input and selected product
        clonedProdukItem.querySelector('select').value = '';
        clonedProdukItem.querySelector('input').value = '';
        
        // Reset the max quantity for new input
        clonedProdukItem.querySelector('input').setAttribute('max', 1); // Default max quantity
        
        // Append the cloned item to the container
        produkContainer.appendChild(clonedProdukItem);
    });
</script>
</x-app-layout>
