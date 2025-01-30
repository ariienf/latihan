<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Detail Penawaran #{{ $penawaran->id }}</h1>
        <p><strong>Customer:</strong> {{ $penawaran->customer->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $penawaran->tanggal->format('d-m-Y') }}</p>
        <p><strong>Status:</strong> {{ $penawaran->status }}</p>
    
        <h2 class="text-xl font-semibold mt-4">Detail Produk</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Produk</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penawaran->detailPenawarans as $detail)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->produk->nama }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->jumlah }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-200 text-center">
                    <td colspan="3" class="border border-gray-300 px-4 py-2 font-semibold">Total</td>
                    <td class="border border-gray-300 px-4 py-2 font-semibold">{{ number_format($totalSubtotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </x-app-layout>