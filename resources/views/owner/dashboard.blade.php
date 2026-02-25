<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            <i class="fas fa-tachometer-alt me-2"></i>Owner Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-lg mb-6 p-6">
            <h1 class="text-2xl font-bold text-white">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-indigo-100 mt-1">Laporan dan analisis parking</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Pendapatan Hari Ini</p>
                <p class="text-xl font-bold text-green-600">Rp {{ number_format(\App\Models\Transaction::whereDate('created_at', today())->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
                <p class="text-xl font-bold text-blue-600">Rp {{ number_format(\App\Models\Transaction::whereMonth('created_at', now()->month())->whereYear('created_at', now()->year())->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Transaction::where('status', 'completed')->count() }}</p>
            </div>
        </div>

        <!-- Report Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <a href="{{ route('owner.reports.daily') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline border-l-4 border-blue-500">
                <i class="fas fa-calendar-day text-blue-600 text-2xl"></i>
                <div>
                    <h3 class="font-semibold text-gray-800">Laporan Harian</h3>
                    <p class="text-sm text-gray-500">Lihat laporan per hari</p>
                </div>
            </a>
            <a href="{{ route('owner.reports.monthly') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline border-l-4 border-purple-500">
                <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
                <div>
                    <h3 class="font-semibold text-gray-800">Laporan Bulanan</h3>
                    <p class="text-sm text-gray-500">Lihat laporan per bulan</p>
                </div>
            </a>
            <a href="{{ route('owner.reports.custom') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline border-l-4 border-green-500">
                <i class="fas fa-search text-green-600 text-2xl"></i>
                <div>
                    <h3 class="font-semibold text-gray-800">Laporan Custom</h3>
                    <p class="text-sm text-gray-500">Pilih tanggal sendiri</p>
                </div>
            </a>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800"><i class="fas fa-history me-2 text-gray-400"></i>Transaksi Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Tiket</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kendaraan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Area</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Masuk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluar</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(\App\Models\Transaction::where('status', 'completed')->latest()->take(5)->get() as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $transaction->ticket_number }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->vehicle->plate_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->parkingArea->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaction->exit_time)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 font-medium text-green-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-receipt text-3xl mb-2"></i>
                                <p>Belum ada transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
