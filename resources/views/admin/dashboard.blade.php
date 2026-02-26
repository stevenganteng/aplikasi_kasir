<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white leading-tight">Admin Dashboard</h2>
                    <p class="text-blue-200 text-xs">GrandBatam Parking System</p>
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
        <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-900 rounded-2xl shadow-xl mb-6 p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-white">Halo, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100 mt-2 text-lg">Selamat datang di dashboard admin</p>
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Area Parkir</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\ParkingArea::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Parkir Aktif</p>
                <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Transaction::where('status', 'parking')->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <p class="text-xl font-bold text-green-600">Rp {{ number_format(\App\Models\Transaction::where('status', 'completed')->sum('total_price') ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <a href="{{ route('admin.users.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Kelola Users</h3>
                    <p class="text-sm text-gray-500">Manajemen pengguna</p>
                </div>
            </a>
            <a href="{{ route('admin.tariffs.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Kelola Tarif</h3>
                    <p class="text-sm text-gray-500">Atur tarif parking</p>
                </div>
            </a>
            <a href="{{ route('admin.parking-areas.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-md transition flex items-center gap-4 no-underline">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Kelola Area</h3>
                    <p class="text-sm text-gray-500">Kelola area parking</p>
                </div>
            </a>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800"><i class="fas fa-history me-2 text-gray-400"></i>Transaksi Terakhir</h3>
                <a href="{{ route('admin.activity-logs.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Tiket</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kendaraan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Area</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Masuk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(\App\Models\Transaction::latest()->take(5)->get() as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $transaction->ticket_number }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->vehicle->plate_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $transaction->parkingArea->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                @if($transaction->status == 'parking')
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Parkir</span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-3xl mb-2"></i>
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
