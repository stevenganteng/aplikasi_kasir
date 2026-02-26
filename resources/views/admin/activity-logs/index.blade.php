<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-history me-2 text-red-600"></i>{{ __('Log Aktivitas') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Log Aktivitas</h3>
                        <p class="text-sm text-gray-500">Riwayat aktivitas pengguna dalam sistem</p>
                    </div>
                    @if($activityLogs->count() > 0)
                        <form action="{{ route('admin.activity-logs.clear') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus semua log?')">
                                Hapus Semua Log
                            </button>
                        </form>
                    @endif
                </div>

                    @if($activityLogs->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($activityLogs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $log->user->name ?? 'System' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($log->action == 'create') bg-green-100 text-green-800
                                        @elseif($log->action == 'update') bg-blue-100 text-blue-800
                                        @elseif($log->action == 'delete') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($log->action) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ $log->description }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $activityLogs->links() }}
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <p>Belum ada aktivitas.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
