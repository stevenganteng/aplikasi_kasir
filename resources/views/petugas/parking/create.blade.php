<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-car-side me-2 text-blue-600"></i>{{ __('Vehicle Entry') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-base font-semibold text-gray-900">Data Kendaraan Masuk</h3>
                    <p class="text-xs text-gray-500">Input informasi kendaraan untuk membuat tiket parkir baru.</p>
                </div>
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
                            <select id="vehicle_type" name="vehicle_type" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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
                            <select id="parking_area_id" name="parking_area_id" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Parking Area</option>
                                @foreach($parkingAreas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }} ({{ $area->available_spaces }} spaces available)</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('parking_area_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tariff_id" :value="__('Tariff')" />
                            <select id="tariff_id" name="tariff_id" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Tariff</option>
                                @foreach($tariffs as $tariff)
                                    <option value="{{ $tariff->id }}">{{ $tariff->name }} - Rp {{ number_format($tariff->price_per_hour, 0, ',', '.') }}/hour</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tariff_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                <i class="fas fa-ticket-alt me-2"></i>{{ __('Create Parking Ticket') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
