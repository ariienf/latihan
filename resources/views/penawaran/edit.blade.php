<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h2 class="text-3xl font-semibold text-black mt-6">Edit Penawaran</h2>

        <form action="{{ route('penawaran.update', $penawaran->id) }}" method="POST" class="mt-8">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Customer -->
                <div class="mb-6">
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                    <select id="customer_id" name="customer_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $penawaran->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- User -->
                <div class="mb-6">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                    <select id="user_id" name="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $penawaran->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="Success" {{ $penawaran->status == 'Success' ? 'selected' : '' }}>Success</option>
                        <option value="On Progress" {{ $penawaran->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div class="mb-6">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $penawaran->tanggal->format('Y-m-d') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('tanggal')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button Submit -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-black font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-300">
                        Update Penawaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
