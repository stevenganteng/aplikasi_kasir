<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tariff Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Name:</h3>
                        <p>{{ $tariff->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Price per Hour:</h3>
                        <p>Rp {{ number_format($tariff->price_per_hour, 0, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Price per Day:</h3>
                        <p>Rp {{ number_format($tariff->price_per_day ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Description:</h3>
                        <p>{{ $tariff->description ?? '-' }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Status:</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tariff->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $tariff->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.tariffs.edit', $tariff->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <a href="{{ route('admin.tariffs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
