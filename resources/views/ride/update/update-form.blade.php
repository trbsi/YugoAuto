<?php
/** @var $ride \App\Models\Ride */

/** @var $driverProfile \App\Models\DriverProfile */

use App\Enum\TimeEnum;

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit ride') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <form method="POST" action="{{route('ride.update')}}">
                        @csrf
                        <input type="hidden" name="ride_id" value="{{$ride->getId()}}">

                        <div class="mb-6">
                            <label for="from_place"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('From place')}}</label>
                            {{$ride->fromPlace->getName()}}
                        </div>

                        <div class="mb-6">
                            <label for="to_place"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('To place')}}</label>
                            {{$ride->toPlace->getName()}}
                        </div>

                        <div class="mb-6">
                            <label for="time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Minimum departure time')}}</label>
                            {{$ride->getRideTime()->format(TimeEnum::DATETIME_FORMAT->value)}}
                        </div>

                        <div class="mb-6">
                            <label for="number_of_seats"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Number of seats')}}</label>
                            <input type="number" id="number_of_seats" name="number_of_seats"
                                   min="1"
                                   max="10"
                                   value="{{$ride->getNumberOfSeats()}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="3" required>
                        </div>

                        <div class="mb-6">
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{__('Price')}} {{$ride->getCurrency()}}
                            </label>
                            {{$ride->getPrice()}}
                        </div>

                        <div class="mb-6">
                            <x-label for="car" value="{{ __('Car') }}"/>
                            <select
                                id="car"
                                name="car"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if($driverProfile)
                                    <option
                                        value="{{$driverProfile->getCarNameAndPlate()}}"
                                        @if($ride->getCar() === $driverProfile->getCarNameAndPlate()) selected @endif
                                    >
                                        {{$driverProfile->getCarNameAndPlate()}}
                                    </option>
                                    @foreach($driverProfile->getAdditionalCarsCollection()->getCars() as $car)
                                        <option
                                            value="{{$car->getCarNameAndPlate()}}"
                                            @if($ride->getCar() === $car->getCarNameAndPlate()) selected @endif
                                        >
                                            {{$car->getCarNameAndPlate()}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Description')}}
                            </label>
                            <textarea type="number" id="description" name="description"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >{{$ride->getDescription()}}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="is_accepting_package"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Do you accept packages?')}}
                            </label>
                            <x-input
                                type="checkbox"
                                id="is_accepting_package"
                                name="is_accepting_package"
                                :checked="$ride->getIsAcceptingPackage()"

                            />
                        </div>

                        <div class=" mb-6">
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{__('Save')}}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script>
            $(function () {
                $('#from_place').tokenInput('add', {
                    id: {{$ride->fromPlace->getId()}},
                    name: '{{$ride->fromPlace->getName()}}'
                });
                $('#to_place').tokenInput('add', {
                    id: {{$ride->toPlace->getId()}},
                    name: '{{$ride->toPlace->getName()}}'
                });
            });
        </script>
    @endpush

</x-app-layout>
