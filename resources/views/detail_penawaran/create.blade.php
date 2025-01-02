<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mt-6">Tambah Detail Penawaran</h2>

        <form action="{{ route('detail_penawaran.store') }}" method="POST" class="mt-6">
            @csrf

            <!-- Memilih Penawaran -->
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="penawaran_id" class="block text-sm font-medium text-gray-700">Pilih Penawaran</label>
                    <select id="penawaran_id" name="penawaran_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">-- Pilih Penawaran --</option>
                        @foreach($penawarans as $penawaran)
                            <option value="{{ $penawaran->id }}">{{ $penawaran->id }} - {{ $penawaran->customer->nama }} ({{ $penawaran->status }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Memilih Produk -->
                <div>
                    <label for="produk_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                    <select id="produk_id" name="produk_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                                {{ $produk->nama }} (Stok: {{ $produk->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Subtotal -->
                <div>
                    <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal</label>
                    <input type="text" id="subtotal" name="subtotal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-black font-bold py-2 px-4 rounded">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const produkSelect = document.getElementById('produk_id');
        const jumlahInput = document.getElementById('jumlah');
        const subtotalInput = document.getElementById('subtotal');

        produkSelect.addEventListener('change', updateSubtotal);
        jumlahInput.addEventListener('input', updateSubtotal);

        function updateSubtotal() {
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = selectedOption.dataset.harga;
            const jumlah = jumlahInput.value;

            if (harga && jumlah) {
                subtotalInput.value = harga * jumlah;
            }
        }

        // Initialize the subtotal on page load
        updateSubtotal();
    </script>
</x-app-layout>
