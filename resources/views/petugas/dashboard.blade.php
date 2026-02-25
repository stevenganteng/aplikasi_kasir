<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            <i class="fas fa-tachometer-alt me-2"></i>Petugas Dashboard
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-xl shadow-lg mb-6 p-6">
            <h1 class="text-2xl font-bold text-white">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-green-100 mt-1">Kelola parking dengan mudah</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Parkir Aktif</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Transaction::where('status', 'parking')->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Transaksi Hari Ini</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Transaction::whereDate('created_at', today())->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Pendapatan Hari Ini</p>
                <p class="text-xl font-bold text-green-600">Rp {{ number_format(\App\Models\Transaction::whereDate('created_at', today())->where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <a href="{{ route('petugas.parking.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 hover:shadow-xl transition no-underline">
                <div class="flex items-center gap-4">
                    <i class="fas fa-sign-in-alt text-white text-3xl"></i>
                    <div>
                        <h3 class="text-xl font-bold text-white">Entry Kendaraan</h3>
                        <p class="text-blue-100 text-sm">Catat kendaraan masuk</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('petugas.parking.active') }}" class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl shadow-lg p-6 hover:shadow-xl transition no-underline">
                <div class="flex items-center gap-4">
                    <i class="fas fa-sign-out-alt text-white text-3xl"></i>
                    <div>
                        <h3 class="text-xl font-bold text-white">Exit Kendaraan</h3>
                        <p class="text-orange-100 text-sm">Proses kendaraan keluar</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Active Parking -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800"><i class="fas fa-car me-2 text-gray-400"></i>Parkir Aktif</h3>
                <a href="{{ route('petugas.parking.active') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Tiket</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plat Nomor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Area</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Masuk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(\App\Models\Transaction::where('status', 'parking')->latest()->take(5)->get() as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $transaction->ticket_number }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->vehicle->plate_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->parkingArea->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('petugas.parking.exit', $transaction->id) }}" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm font-medium">
                                    <i class="fas fa-sign-out-alt me-1"></i> Exit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-car text-3xl mb-2"></i>
                                <p>Tidak ada kendaraan aktif</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
