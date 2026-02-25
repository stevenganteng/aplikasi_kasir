@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Laporan Transaksi</h1>
                    <a href="{{ route('owner.reports.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>

                <!-- Report Period -->
                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg mb-6">
                    <p class="text-lg font-semibold">Periode Laporan:</p>
                    <p>{{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-blue-600 p-4 rounded-lg">
                        <p class="text-sm text-blue-100">Total Transaksi</p>
                        <p class="text-2xl font-bold">{{ $totalTransactions }}</p>
                    </div>
                    <div class="bg-green-600 p-4 rounded-lg">
                        <p class="text-sm text-green-100">Total Pendapatan</p>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-purple-600 p-4 rounded-lg">
                        <p class="text-sm text-purple-100">Rata-rata Transaksi</p>
                        <p class="text-2xl font-bold">Rp {{ number_format($averageTransaction, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- By Area -->
                @if($byArea->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4">Rekap per Area Parkir</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">Area</th>
                                    <th class="px-4 py-2 text-right">Jumlah Transaksi</th>
                                    <th class="px-4 py-2 text-right">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($byArea as $areaId => $data)
                                <tr class="border-b dark:border-gray-600">
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
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-right">Jumlah Transaksi</th>
                                    <th class="px-4 py-2 text-right">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($byDate as $date => $data)
                                <tr class="border-b dark:border-gray-600">
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
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">No. Tiket</th>
                                    <th class="px-4 py-2 text-left">Plat Nomor</th>
                                    <th class="px-4 py-2 text-left">Area</th>
                                    <th class="px-4 py-2 text-left">Masuk</th>
                                    <th class="px-4 py-2 text-left">Keluar</th>
                                    <th class="px-4 py-2 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="px-4 py-2">{{ $transaction->ticket_number }}</td>
                                    <td class="px-4 py-2">{{ $transaction->vehicle->plate_number }}</td>
                                    <td class="px-4 py-2">{{ $transaction->parkingArea->name }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->exit_time)->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-2 text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center">Tidak ada transaksi dalam periode ini.</td>
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
@endsection
