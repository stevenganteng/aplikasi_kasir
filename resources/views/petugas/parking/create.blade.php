<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vehicle Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('petugas.parking.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="plate_number" :value="__('Plate Number')" />
                            <x-text-input id="plate_number" class="block mt-1 w-full" type="text" name="plate_number" :value="old('plate_number')" required placeholder="e.g. B 1234 XYZ" />
                            <x-input-error :messages="$errors->get('plate_number')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                            <select id="vehicle_type" name="vehicle_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm" required>
                                <option value="">Select Type</option>
                                <option value="motor">Motorcycle</option>
                                <option value="mobil">Car</option>
                                <option value="truk">Truck</option>
                                <option value="sepeda">Bike</option>
                            </select>
                            <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parking_area_id" :value="__('Parking Area')" />
                            <select id="parking_area_id" name="parking_area_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm" required>
                                <option value="">Select Parking Area</option>
                                @foreach($parkingAreas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }} ({{ $area->available_spaces }} spaces available)</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parking_area_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tariff_id" :value="__('Tariff')" />
                            <select id="tariff_id" name="tariff_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm" required>
                                <option value="">Select Tariff</option>
                                @foreach($tariffs as $tariff)
                                    <option value="{{ $tariff->id }}">{{ $tariff->name }} - Rp {{ number_format($tariff->price_per_hour, 0, ',', '.') }}/hour</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tariff_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Parking Ticket') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
