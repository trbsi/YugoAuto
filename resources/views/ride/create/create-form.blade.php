<?php
/** @var $driverProfile \App\Models\DriverProfile */

/** @var $transitPlaces \Illuminate\Database\Eloquent\Collection */
/** @var $toPlace \App\Models\Place */
/** @var $fromPlace \App\Models\Place */
/** @var $transitPlace \App\Models\Place */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create ride') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    <form method="POST" action="{{route('ride.save')}}">
                        @csrf
                        <div class="mb-6">
                            <label for="from_place"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('From place')}}</label>
                            <input type="text" id="from_place"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>

                            <input
                                type="hidden"
                                name="from_place_id"
                                id="from_place_id" required>
                        </div>

                        <div class="mb-6">
                            <label for="transit_places"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Transit places')}}</label>
                            <input type="text"
                                   id="transit_places"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>

                            <input
                                type="hidden"
                                name="transit_places_ids"
                                id="transit_places_ids" required>
                        </div>

                        <div class="mb-6">
                            <label for="to_place"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('To place')}}</label>
                            <input type="text" id="to_place"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>

                            <input
                                type="hidden"
                                name="to_place_id"
                                id="to_place_id" required>
                        </div>

                        <div class="mb-6">
                            <label for="time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Minimum departure time')}}</label>
                            <input type="text"
                                   name="time"
                                   readonly
                                   value="{{old('time')}}"
                                   class="datetimepicker bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                        </div>

                        <div class="mb-6">
                            <label for="number_of_seats"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Number of seats')}}</label>
                            <input type="number" id="number_of_seats" name="number_of_seats"
                                   min="1"
                                   max="10"
                                   value="{{old('number_of_seats')}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="3" required>
                        </div>

                        <div class="mb-6">
                            <label for="price"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{__('Price')}} {{get_user_currency()}}
                            </label>
                            <input type="number" id="price" name="price"
                                   value="{{old('price')}}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="15" required>
                        </div>

                        <div class="mb-6">
                            <x-label for="car" value="{{ __('Car') }}"/>
                            <select
                                id="car"
                                name="car"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if($driverProfile)
                                    <option value="{{$driverProfile->getCarNameAndPlate()}}">
                                        {{$driverProfile->getCarNameAndPlate()}}
                                    </option>
                                    @foreach($driverProfile->getAdditionalCarsCollection()->getCars() as $car)
                                        <option value="{{$car->getCarNameAndPlate()}}">
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
                            >{{old('description')}}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="is_accepting_package"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Do you accept packages?')}}
                            </label>
                            <x-input type="checkbox" id="is_accepting_package" name="is_accepting_package"/>
                        </div>

                        <div class=" mb-6">
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{__('Create')}}
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
                @if(!empty($fromPlace))
                $('#from_place').tokenInput('add', {id: {{$fromPlace->getId()}}, name: '{{$fromPlace->getName()}}'});
                @endif

                @if(!empty($toPlace))
                $('#to_place').tokenInput('add', {id: {{$toPlace->getId()}}, name: '{{$toPlace->getName()}}'});
                @endif

                @if($transitPlaces->isNotEmpty())
                var tmpTransitPlaces = [
                        @foreach($transitPlaces as $transitPlace)
                    {
                        id: {{$transitPlace->getId()}}, name: '{{$transitPlace->getName()}}'
                    },
                    @endforeach
                ];

                tmpTransitPlaces.forEach(function (element) {
                    $('#transit_places').tokenInput('add', element);
                })
                @endif

            });
        </script>
    @endpush
</x-app-layout>
