<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vehicle Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <x-input-label for="plate_number" :value="__('Plate Number')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">{{ $vehicle->plate_number }}</div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">
                            @if($vehicle->type == 'motor') Motorcycle
                            @elseif($vehicle->type == 'mobil') Car
                            @elseif($vehicle->type == 'truk') Truck
                            @elseif($vehicle->type == 'sepeda') Bike
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="brand" :value="__('Brand')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">{{ $vehicle->brand ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="color" :value="__('Color')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">{{ $vehicle->color ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="owner_name" :value="__('Owner Name')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">{{ $vehicle->owner_name ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="owner_phone" :value="__('Owner Phone')" />
                        <div class="mt-1 text-gray-900 dark:text-gray-100">{{ $vehicle->owner_phone ?? '-' }}</div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.vehicles.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">Back</a>
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
