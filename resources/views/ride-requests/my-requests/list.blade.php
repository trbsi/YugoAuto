<?php
/** @var \App\Models\Ride $ride */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My requests') }}
        </h2>
    </x-slot>

    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">

                <div class="p-6 lg:p-8">
                    <h1 class="pb-6 text-4xl">{{$ride->fromPlace->getName()}} - {{$ride->toPlace->getName()}}</h1>

                    <div class="flex flex-col">
                        <div class="flex flex-row">
                            <div class="flex-1 font-bold">
                                {{__('Driver')}}:
                            </div>
                            <div class="flex-1">
                                <a class="underline"
                                   href="{{user_profile_url($ride->getDriverId())}}">
                                    {{$ride->driver->getName()}}
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-row ">
                            <div class="flex-1 font-bold">
                                {{__('Departure time')}}:
                            </div>
                            <div class="flex-1">
                                {{$ride->getRideTimeFormatted()}}
                            </div>
                        </div>
                        <div class="flex flex-row ">
                            <div class="flex-1 font-bold">
                                {{__('Is accepting package')}}
                            </div>
                            <div class="flex-1">
                                @if($ride->getIsAcceptingPackage())
                                    <x-checkmark type="tick"/>
                                @else
                                    <x-checkmark type="cross"/>
                                @endif
                            </div>
                        </div>


                        @if ($ride->driver->driverProfile && ($ride->isMyRide() || $ride->rideRequestForAuthUser->isAccepted()))
                            <div class="flex flex-row ">
                                <div class="flex-1 font-bold">
                                    {{__('Car name')}}:
                                </div>
                                <div class="flex-1">
                                    @if ($ride->getCar())
                                        {{$ride->getCar()}}
                                    @else
                                        {{$ride->driver->driverProfile->getCarNameAndPlate()}}
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-row ">
                                <div class="flex-1 font-bold">
                                    {{__('Animals allowed')}}
                                </div>
                                <div class="flex-1">
                                    @include('driver-profiles.components.smoking-animals', [
                                        'driverProfile' => $ride->driver->driverProfile,
                                        'type' => 'animals'
                                    ])
                                </div>
                            </div>

                            <div class="flex flex-row ">
                                <div class="flex-1 font-bold">
                                    {{__('Smoking allowed')}}
                                </div>
                                <div class="flex-1">
                                    @include('driver-profiles.components.smoking-animals', [
                                        'driverProfile' => $ride->driver->driverProfile,
                                        'type' => 'smoking'
                                    ])
                                </div>
                            </div>
                        @endif


                        <div class="flex flex-row ">
                            <div class="flex-1 ">
                                <span class="font-bold">{{__('Phone')}}:</span>
                            </div>
                            <div class="flex-1">
                                <x-phone-number :user="$ride->driver" :forceShow="true" type="main"></x-phone-number>
                            </div>
                        </div>

                        <div class="flex flex-row ">
                            <div class="flex-1 ">
                                <span class="font-bold">{{__('Additional phones')}}:</span>
                            </div>
                            <div class="flex-1">
                                <x-phone-number :user="$ride->driver" :forceShow="true"
                                                type="additional"></x-phone-number>
                            </div>
                        </div>
                    </div>
                </div>

                @if($requests !== null && $requests->isNotEmpty())
                    @include('ride-requests.my-requests.components.list_result')
                @else
                    <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                        <h1 class="text-4xl text-center p-6 dark:text-white">{{__('No requests')}}</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
