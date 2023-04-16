<x-form-section submit="updateDriverProfile">
    <x-slot name="title">
        {{ __('Update driver profile') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add more information about you as a driver so people can trust you more') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="carName" value="{{ __('Car name') }}"/>
            <x-input id="carName" type="text" class="mt-1 block w-full" wire:model.defer="carName"
                     autocomplete="carName" placeholder="BMW X5" required/>
            <x-input-error for="carName" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="carPlate" value="{{ __('Car plate') }}"/>
            <x-input id="carPlate" type="text" class="mt-1 block w-full" wire:model.defer="carPlate"
                     autocomplete="carPlate" required/>
            <x-input-error for="carPlate" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="animals" value="{{ __('Pets allowed') }}"/>
            <x-checkbox id="animals" type="text" class="mt-1" wire:model.defer="animals"
                        autocomplete="animals"/>
            <x-input-error for="animals" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="smoking" value="{{ __('Smoking allowed') }}"/>
            <x-checkbox id="smoking" type="text" class="mt-1" wire:model.defer="smoking"
                        autocomplete="smoking"/>
            <x-input-error for="smoking" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:loading.class="hidden">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
