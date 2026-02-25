@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Laporan Transaksi</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Daily Report Card -->
                    <a href="{{ route('owner.reports.daily') }}" class="block p-6 bg-yellow-600 rounded-lg hover:bg-yellow-700 transition">
                        <h3 class="text-lg font-semibold">Laporan Harian</h3>
                        <p class="text-sm mt-2">Lihat transaksi hari ini</p>
                    </a>

                    <!-- Monthly Report Card -->
                    <a href="{{ route('owner.reports.monthly') }}" class="block p-6 bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        <h3 class="text-lg font-semibold">Laporan Bulanan</h3>
                        <p class="text-sm mt-2">Lihat transaksi bulan ini</p>
                    </a>

                    <!-- Custom Report Card -->
                    <a href="{{ route('owner.reports.custom') }}" class="block p-6 bg-green-600 rounded-lg hover:bg-green-700 transition">
                        <h3 class="text-lg font-semibold">Laporan Custom</h3>
                        <p class="text-sm mt-2">Pilih rentang tanggal sendiri</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
