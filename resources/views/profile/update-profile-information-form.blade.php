<?php

use App\Source\User\Enum\PhoneNumberEnum;

?>
<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <x-label for="photo" value="{{ __('Photo') }}"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                         class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <label for="file"
                       class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 mt-2 mr-2">
                    {{ __('Select A New Photo') }}
                </label>
                <input type="file"
                       accept="image/*"
                       class="hidden"
                       id="file"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>
                <div class="text-sm italic mt-1">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <a class="underline"
                       href="{{route('open-and-redirect', ['route' => 'profile.show'])}}">{{__('If photo upload does not work')}}</a>
                </div>
                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2"/>
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>

        <!-- Phone number -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone_number" value="{{ __('Primary phone number') }}"/>
            <x-input id="phone_number"
                     :disabled="$state['is_phone_number_verified']"
                     type="text"
                     class="mt-1 block w-full"
                     wire:model.defer="state.phone_number"
                     autocomplete="phone_number"
                     placeholder="+385..."/>

            <x-input-error for="phone_number" class="mt-2"/>

            <x-label for="is_phone_number_public" value="{{ __('Is phone number visible on your profile') }}"/>
            <x-checkbox id="is_phone_number_public"
                        class="mt-1 block"
                        wire:model.defer="state.is_phone_number_public"/>

            <x-input-error for="is_phone_number_public" class="mt-2"/>

            @if(!$state['is_phone_number_verified'])
                <x-anchor role="red"
                          :url="route('phone-verification.show')"
                          :text="__('Verify phone number')"></x-anchor>
            @endif
        </div>

        <!-- Additional Phones -->
        <div class="col-span-6 sm:col-span-4 bg-gray-100 p-4">
            <div class="pb-4">{{__('Additional phones')}}</div>
            <div class="italic text-sm mb-4">
                {{ __('These phones will be visible on your public profile only if your main phone is visible') }}
            </div>

            @for($i = 0; $i < PhoneNumberEnum::MAX_ADDITIONAL_NUMBERS->value ;$i++)
                <div class="mb-2 mt-2">
                    <x-label for="phone_number_{{$i}}" value="{{ __('Phone number') }}"/>
                    <x-input id="phone_number_{{$i}}"
                             :disabled="$state['additional_phones'][$i]['isVerified'] ?? false"
                             type="text"
                             class="mt-1 block w-full"
                             wire:model.defer="state.additional_phones.{{$i}}.phoneNumber"
                             autocomplete="phone_number_{{$i}}"
                             placeholder="+385..."/>
                    <x-input-error for="additional_phones.{{$i}}.phoneNumber" class="mt-2"/>
                </div>

                <div class="border-b border-gray-300 border-solid border-1"></div>
            @endfor
        </div>


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}"/>
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"
                     autocomplete="username"/>
            <x-input-error for="email" class="mt-2"/>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent"
                       class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-label class="mr-1" wire:loading.block>
            {{ __('Wait until it loads and then save') }}
        </x-label>

        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:loading.class="hidden" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
