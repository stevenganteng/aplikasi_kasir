<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-briefcase text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white leading-tight">Owner Dashboard</h2>
                    <p class="text-purple-200 text-xs">GrandBatam Parking System</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-2 text-white/80 text-sm">
                <i class="fas fa-user-circle"></i>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-xl mb-6 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-white">Halo, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-indigo-100 mt-2 text-lg">Pantau laporan dan pendapatan parking</p>
                <div class="flex gap-4 mt-4">
                    <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-sm text-white">
                        <i class="fas fa-calendar-alt mr-2"></i>{{ now()->format('d F Y') }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-sm text-white">
                        <i class="fas fa-clock mr-2"></i>{{ now()->format('H:i') }} WIT
                    </span>
                </div>
            </div>
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
