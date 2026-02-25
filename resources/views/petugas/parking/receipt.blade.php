<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Receipt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" id="print-area">
                    <!-- Receipt Header -->
                    <div class="text-center border-b-2 border-dashed border-gray-300 pb-4 mb-4">
                        <h2 class="text-xl font-bold">GRAND BATAM MALL</h2>
                        <p class="text-sm text-gray-500">Sistem Parkir</p>
                    </div>

                    <!-- Receipt Details -->
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-500">No. Tiket</span>
                            <span class="font-bold">{{ $transaction->ticket_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Plat Nomor</span>
                            <span class="font-bold">{{ $transaction->vehicle->plate_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jenis</span>
                            <span>
                                @if($transaction->vehicle->type == 'motor') Motor
                                @elseif($transaction->vehicle->type == 'mobil') Mobil
                                @elseif($transaction->vehicle->type == 'truk') Truk
                                @elseif($transaction->vehicle->type == 'sepeda') Sepeda
                                @else{{ ucfirst($transaction->vehicle->type) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Area</span>
                            <span>{{ $transaction->parkingArea->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jam Masuk</span>
                            <span>{{ \Carbon\Carbon::parse($transaction->entry_time)->format('H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jam Keluar</span>
                            <span>{{ $transaction->exit_time ? \Carbon\Carbon::parse($transaction->exit_time)->format('H:i') : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Durasi</span>
                            <span>{{ $duration }}</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t-2 border-dashed border-gray-300 mt-4 pt-4">
                        <div class="flex justify-between text-xl font-bold">
                            <span>TOTAL</span>
                            <span class="text-yellow-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>
                        @if($transaction->status == 'completed')
                        <div class="flex justify-between mt-2">
                            <span class="text-gray-500">Bayar</span>
                            <span>Rp {{ number_format($paymentAmount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kembalian</span>
                            <span>Rp {{ number_format($change, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-6 pt-4 border-t-2 border-dashed border-gray-300">
                        <p class="text-sm text-gray-500">Terima kasih atas kunjungan Anda</p>
                        @if($transaction->exit_time)
                        <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($transaction->exit_time)->format('d-m-Y H:i:s') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-6 pt-0 flex gap-4">
                    <button onclick="window.print()" class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-4 rounded-lg transition">
                        Cetak Struk
                    </button>
                    <a href="{{ route('petugas.parking.active') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transition text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-area, #print-area * {
            visibility: visible;
        }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
    </style>
</x-app-layout>
