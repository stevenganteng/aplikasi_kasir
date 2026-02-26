<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-car me-2 text-indigo-600"></i>{{ __('Edit Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-base font-semibold text-gray-900">Perbarui Data Kendaraan</h3>
                    <p class="text-xs text-gray-500">Edit informasi kendaraan milik pelanggan.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="plate_number" :value="__('Plate Number')" />
                            <x-text-input id="plate_number" class="block mt-1 w-full" type="text" name="plate_number" :value="old('plate_number', $vehicle->plate_number)" required />
                            <x-input-error :messages="$errors->get('plate_number')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Type</option>
                                <option value="motor" {{ $vehicle->type == 'motor' ? 'selected' : '' }}>Motorcycle</option>
                                <option value="mobil" {{ $vehicle->type == 'mobil' ? 'selected' : '' }}>Car</option>
                                <option value="truk" {{ $vehicle->type == 'truk' ? 'selected' : '' }}>Truck</option>
                                <option value="sepeda" {{ $vehicle->type == 'sepeda' ? 'selected' : '' }}>Bike</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="brand" :value="__('Brand')" />
                            <x-text-input id="brand" class="block mt-1 w-full" type="text" name="brand" :value="old('brand', $vehicle->brand)" />
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="color" :value="__('Color')" />
                            <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color', $vehicle->color)" />
                            <x-input-error :messages="$errors->get('color')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="owner_name" :value="__('Owner Name')" />
                            <x-text-input id="owner_name" class="block mt-1 w-full" type="text" name="owner_name" :value="old('owner_name', $vehicle->owner_name)" />
                            <x-input-error :messages="$errors->get('owner_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="owner_phone" :value="__('Owner Phone')" />
                            <x-text-input id="owner_phone" class="block mt-1 w-full" type="text" name="owner_phone" :value="old('owner_phone', $vehicle->owner_phone)" />
                            <x-input-error :messages="$errors->get('owner_phone')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                <i class="fas fa-save me-2"></i>{{ __('Update Vehicle') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
