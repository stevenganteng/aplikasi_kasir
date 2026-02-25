<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-map-marker-alt me-2 text-green-600"></i>{{ __('Kelola Area Parkir') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Total Area</p>
                            <p class="text-3xl font-bold">{{ \App\Models\ParkingArea::count() }}</p>
                        </div>
                        <i class="fas fa-map text-white/30 text-4xl"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Total Kapasitas</p>
                            <p class="text-3xl font-bold">{{ \App\Models\ParkingArea::sum('capacity') }}</p>
                        </div>
                        <i class="fas fa-car text-white/30 text-4xl"></i>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm">Tersedia</p>
                            <p class="text-3xl font-bold">{{ \App\Models\ParkingArea::sum('available_spaces') }}</p>
                        </div>
                        <i class="fas fa-parking text-white/30 text-4xl"></i>
                    </div>
                </div>
            </div>

            <!-- Parking Areas Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list me-2 text-gray-400"></i>Daftar Area Parkir
                    </h3>
                    <a href="{{ route('admin.parking-areas.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-plus"></i> Tambah Area
                    </a>
                </div>

                @if(session('success'))
                    <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-600 flex items-center">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </p>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Area</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tersedia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($parkingAreas as $area)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">{{ $area->code }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ $area->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $area->location ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $area->capacity }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium {{ $area->available_spaces > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $area->available_spaces }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($area->is_active)
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <i class="fas fa-check me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <i class="fas fa-times me-1"></i>Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.parking-areas.show', $area->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.parking-areas.edit', $area->id) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.parking-areas.destroy', $area->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus" onclick="return confirm('Apakah Anda yakin?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-map-marker-alt text-3xl mb-2"></i>
                                    <p>Belum ada area parking</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $parkingAreas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
