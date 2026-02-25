<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Parking Area Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Name:</h3>
                        <p>{{ $parkingArea->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Code:</h3>
                        <p>{{ $parkingArea->code }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Capacity:</h3>
                        <p>{{ $parkingArea->capacity }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Available Spaces:</h3>
                        <p>{{ $parkingArea->available_spaces }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Location:</h3>
                        <p>{{ $parkingArea->location ?? '-' }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Status:</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $parkingArea->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $parkingArea->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.parking-areas.edit', $parkingArea->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <a href="{{ route('admin.parking-areas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
