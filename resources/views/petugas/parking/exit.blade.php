<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Keluar Parkir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Keluar Parkir</h1>

                    <!-- Vehicle Info -->
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">No. Tiket</p>
                                <p class="font-semibold text-lg">{{ $transaction->ticket_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Plat Nomor</p>
                                <p class="font-semibold text-lg">{{ $transaction->vehicle->plate_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jenis Kendaraan</p>
                                <p class="font-semibold">
                                    @if($transaction->vehicle->type == 'motor') Motor
                                    @elseif($transaction->vehicle->type == 'mobil') Mobil
                                    @elseif($transaction->vehicle->type == 'truk') Truk
                                    @elseif($transaction->vehicle->type == 'sepeda') Sepeda
                                    @else{{ ucfirst($transaction->vehicle->type) }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Area Parkir</p>
                                <p class="font-semibold">{{ $transaction->parkingArea->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Waktu Masuk</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Durasi</p>
                                <p class="font-semibold">{{ $duration }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form method="POST" action="{{ route('petugas.parking.exit.process', $transaction->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Total Bayar</label>
                            <p class="text-3xl font-bold text-yellow-600">
                                Rp {{ number_format($totalPrice, 0, ',', '.') }}
                            </p>
                            <p class="text-sm font-normal text-gray-500">{{ $duration }}</p>
                        </div>

                        <div class="mb-6">
                            <x-input-label for="payment_amount" :value="__('Jumlah Pembayaran')" />
                            <x-text-input id="payment_amount" class="block mt-1 w-full" type="number" name="payment_amount" required min="0" placeholder="Masukkan jumlah uang" />
                            <x-input-error :messages="$errors->get('payment_amount')" class="mt-2" />
                        </div>

                        <div class="flex gap-4">
                            <x-primary-button class="flex-1 justify-center">
                                Proses Pembayaran
                            </x-primary-button>
                            <a href="{{ route('petugas.parking.active') }}" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100 transition text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
