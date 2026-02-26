<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-car me-2 text-indigo-600"></i>{{ __('Kendaraan Management') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Kendaraan</h3>
                            <p class="text-sm text-gray-500">Daftar kendaraan yang terdaftar di sistem</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.vehicles.create') }}"
                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-sm">
                        <i class="fas fa-plus text-xs"></i>
                        <span>Add Vehicle</span>
                    </a>
                </div>

                <div class="p-6">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plat Nomor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kendaraan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Datang Terakhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Keluar Terakhir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($vehicles as $vehicle)
                            @php
                                $lastTransaction = $vehicle->transactions->first();
                            @endphp
                            <tr>
                                <td class="px-6 py-4">{{ $vehicle->plate_number }}</td>
                                <td class="px-6 py-4">{{ ucfirst($vehicle->type) }}</td>
                                <td class="px-6 py-4">
                                    {{ $lastTransaction && $lastTransaction->entry_time ? $lastTransaction->entry_time->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $lastTransaction && $lastTransaction->exit_time ? $lastTransaction->exit_time->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No vehicles found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        @if($vehicles->hasPages())
                            {{ $vehicles->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
