<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-day me-2 text-indigo-600"></i>{{ __('Laporan Harian') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Harian - {{ $today->format('d/m/Y') }}</h3>
                        <p class="text-xs text-gray-500">Ringkasan transaksi dan pendapatan parkir untuk tanggal ini.</p>
                    </div>
                    <a href="{{ route('owner.dashboard') }}" class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg text-sm shadow-sm">
                        <i class="fas fa-arrow-left text-xs"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="p-6">
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

                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left font-medium text-gray-600">No. Tiket</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-600">Kendaraan</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-600">Area</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-600">Masuk</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-600">Keluar</th>
                                <th class="px-4 py-2 text-right font-medium text-gray-600">Total</th>
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
