<?php

use App\Source\DriverProfile\Enum\DriverCarEnum;

?>

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

        <!-- Additional Cars -->
        <div class="col-span-6 sm:col-span-4 bg-gray-100 p-4">
            {{__('Additional cars')}}
            @for($i = 0; $i < DriverCarEnum::MAX_ADDITIONAL_CARS->value ;$i++)
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="carName_{{$i}}" value="{{ __('Car name') }}"/>
                    <x-input id="carName_{{$i}}"
                             type="text"
                             class="mt-1 block w-full"
                             wire:model.defer="additionalCars.{{$i}}.carName"
                             autocomplete="carName_{{$i}}" placeholder="BMW X5"/>
                    <x-input-error for="additionalCars.{{$i}}.carName" class="mt-2"/>
                </div>

                <div class="col-span-6 sm:col-span-4 mb-2">
                    <x-label for="carPlate_{{$i}}" value="{{ __('Car plate') }}"/>
                    <x-input id="carPlate_{{$i}}"
                             type="text"
                             class="mt-1 block w-full"
                             wire:model.defer="additionalCars.{{$i}}.carPlate"
                             autocomplete="additionalCars.{{$i}}.carPlate"/>
                    <x-input-error for="additionalCars.{{$i}}.carPlate" class="mt-2"/>
                </div>

                <div class="border-b border-gray-300 border-solid border-1"></div>
            @endfor
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="animals" value="{{ __('Animals allowed') }}"/>
            <x-checkbox id="animals" class="mt-1" wire:model.defer="animals"
                        autocomplete="animals"/>
            <x-input-error for="animals" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="smoking" value="{{ __('Smoking allowed') }}"/>
            <x-checkbox id="smoking" class="mt-1" wire:model.defer="smoking"
                        autocomplete="smoking"/>
            <x-input-error for="smoking" class="mt-2"/>
        </div>

        @if(!$hasPhoneNumber)
            <div class="col-span-6 sm:col-span-4">
                <x-alert role="warning" :content="__('Make sure to add phone number')"></x-alert>
            </div>
        @endif
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
