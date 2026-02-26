<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-tag me-2 text-yellow-600"></i>{{ __('Edit Tariff') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-base font-semibold text-gray-900">Perbarui Tarif Parkir</h3>
                    <p class="text-xs text-gray-500">Sesuaikan informasi tarif parkir sesuai kebutuhan terbaru.</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.tariffs.update', $tariff->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $tariff->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="price_per_hour" :value="__('Price per Hour')" />
                            <x-text-input id="price_per_hour" class="block mt-1 w-full" type="number" step="0.01" name="price_per_hour" :value="old('price_per_hour', $tariff->price_per_hour)" required />
                            <x-input-error :messages="$errors->get('price_per_hour')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="price_per_day" :value="__('Price per Day')" />
                            <x-text-input id="price_per_day" class="block mt-1 w-full" type="number" step="0.01" name="price_per_day" :value="old('price_per_day', $tariff->price_per_day)" />
                            <x-input-error :messages="$errors->get('price_per_day')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm">{{ old('description', $tariff->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ $tariff->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                <i class="fas fa-save me-2"></i>{{ __('Update Tariff') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
