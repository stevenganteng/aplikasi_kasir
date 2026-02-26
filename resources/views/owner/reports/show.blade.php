<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-file-invoice-dollar me-2 text-indigo-600"></i>{{ __('Laporan Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">Laporan Transaksi</h1>
                        <p class="text-xs text-gray-500">
                            Periode {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}
                        </p>
                    </div>
                    <a href="{{ route('owner.reports.index') }}" class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg text-sm shadow-sm">
                        <i class="fas fa-arrow-left text-xs"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="p-6 text-gray-900">
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-blue-600 p-4 rounded-lg text-white">
                            <p class="text-sm text-blue-100">Total Transaksi</p>
                            <p class="text-2xl font-bold">{{ $totalTransactions }}</p>
                        </div>
                        <div class="bg-green-600 p-4 rounded-lg text-white">
                            <p class="text-sm text-green-100">Total Pendapatan</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-600 p-4 rounded-lg text-white">
                            <p class="text-sm text-purple-100">Rata-rata Transaksi</p>
                            <p class="text-2xl font-bold">Rp {{ number_format($averageTransaction, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- By Area -->
                    @if($byArea->count() > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Rekap per Area Parkir</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Area</th>
                                        <th class="px-4 py-2 text-right font-medium text-gray-600">Jumlah Transaksi</th>
                                        <th class="px-4 py-2 text-right font-medium text-gray-600">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($byArea as $areaId => $data)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ \App\Models\ParkingArea::find($areaId)->name ?? 'Unknown' }}</td>
                                        <td class="px-4 py-2 text-right">{{ $data['count'] }}</td>
                                        <td class="px-4 py-2 text-right">Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- By Date -->
                    @if($byDate->count() > 0)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold mb-4">Rekap per Tanggal</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Tanggal</th>
                                        <th class="px-4 py-2 text-right font-medium text-gray-600">Jumlah Transaksi</th>
                                        <th class="px-4 py-2 text-right font-medium text-gray-600">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($byDate as $date => $data)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-2 text-right">{{ $data['count'] }}</td>
                                        <td class="px-4 py-2 text-right">Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- Transaction Details -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">Detail Transaksi</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">No. Tiket</th>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Plat Nomor</th>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Area</th>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Masuk</th>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Keluar</th>
                                        <th class="px-4 py-2 text-right font-medium text-gray-600">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $transaction->ticket_number }}</td>
                                        <td class="px-4 py-2">{{ $transaction->vehicle->plate_number }}</td>
                                        <td class="px-4 py-2">{{ $transaction->parkingArea->name }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->exit_time)->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2 text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada transaksi dalam periode ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
