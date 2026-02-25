<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
                    
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
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
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $transaction->ticket_number }}</td>
                                <td class="px-4 py-2">{{ $transaction->vehicle->plate_number ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $transaction->parkingArea->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->entry_time)->format('d-m-Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $transaction->exit_time ? \Carbon\Carbon::parse($transaction->exit_time)->format('d-m-Y H:i') : '-' }}</td>
                                <td class="px-4 py-2 text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
