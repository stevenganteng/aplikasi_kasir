<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Laporan Harian - {{ $today->format('d/m/Y') }}</h3>
                        <a href="{{ route('owner.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 rounded-lg p-4">
                            <div class="text-sm text-blue-600">Total Transaksi</div>
                            <div class="text-2xl font-bold">{{ $totalTransactions }}</div>
                        </div>
                        <div class="bg-green-100 rounded-lg p-4">
                            <div class="text-sm text-green-600">Total Pendapatan</div>
                            <div class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                        <div class="bg-yellow-100 rounded-lg p-4">
                            <div class="text-sm text-yellow-600">Rata-rata per Transaksi</div>
                            <div class="text-2xl font-bold">Rp {{ number_format($totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left">No. Tiket</th>
                                <th class="px-4 py-2 text-left">Kendaraan</th>
                                <th class="px-4 py-2 text-left">Area</th>
                                <th class="px-4 py-2 text-left">Masuk</th>
                                <th class="px-4 py-2 text-left">Keluar</th>
                                <th class="px-4 py-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $transaction->ticket_number }}</td>
                                <td class="px-4 py-2">{{ $transaction->vehicle->plate_number ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $transaction->parkingArea->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('H:i') }}</td>
                                <td class="px-4 py-2">{{ $transaction->exit_time ? \Carbon\Carbon::parse($transaction->exit_time)->format('H:i') : '-' }}</td>
                                <td class="px-4 py-2 text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
