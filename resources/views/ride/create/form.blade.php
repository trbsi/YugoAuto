<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create ride') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="GET" action="{{route('ride.search')}}">
                    <div class="mb-6">
                        <label for="from_place"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('From place')}}</label>
                        <input type="text" id="from_place"
                               value="{{$fromPlace ? $fromPlace->getName() : $fromPlace}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Zagreb" required>

                        <input
                            type="hidden"
                            value="{{$fromPlace ? $fromPlace->getId() : $fromPlace}}"
                            name="from_place_id"
                            id="from_place_id" required>
                    </div>

                    <div class="mb-6">
                        <label for="to_place"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('To place')}}</label>
                        <input type="text" id="to_place"
                               value="{{$toPlace ? $toPlace->getName() : $toPlace}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Split" required>

                        <input
                            type="hidden"
                            value="{{$toPlace ? $toPlace->getId() : $toPlace}}"
                            name="to_place_id"
                            id="to_place_id" required>
                    </div>

                    <div class="mb-6">
                        <label for="time"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Minimum departure time')}}</label>
                        <input type="datetime-local" id="time" name="time"
                               value="{{$time}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Split" required>
                    </div>

                    <div class=" mb-6">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{__('Search')}}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
