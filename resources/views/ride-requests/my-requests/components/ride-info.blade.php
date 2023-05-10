<?php
/** @var \App\Models\Ride $ride */

?>

<div class="p-6 lg:p-8">
    <h1 class="pb-6 text-4xl">{{$ride->fromPlace->getName()}} - {{$ride->toPlace->getName()}}</h1>

    <div class="flex flex-col">
        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
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
        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
            <div class="flex-1 font-bold">
                {{__('Departure time')}}:
            </div>
            <div class="flex-1">
                {{$ride->getRideTimeFormatted()}}
            </div>
        </div>
        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
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
            <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
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

            <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
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

            <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
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

        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
            <div class="flex-1 ">
                <span class="font-bold">{{__('Phone')}}:</span>
            </div>
            <div class="flex-1">
                <x-phone-number :user="$ride->driver" :forceShow="true" type="main"></x-phone-number>
            </div>
        </div>

        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
            <div class="flex-1">
                <span class="font-bold">{{__('Additional phones')}}:</span>
            </div>
            <div class="flex-1">
                <x-phone-number :user="$ride->driver" :forceShow="true"
                                type="additional"></x-phone-number>
            </div>
        </div>

        <div class="flex flex-row min-h-8 pb-2 pt-2 border-b">
            <div class="flex-1">
                <span class="font-bold">{{__('Description')}}:</span>
            </div>
            <div class="flex-1">
                {{$ride->getDescriptionFormatted()}}
            </div>
        </div>
    </div>
</div>
