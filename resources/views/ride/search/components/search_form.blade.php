<?php
/** @var \App\Models\Place $fromPlace */

/** @var \App\Models\Place $toPlace */
?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <form method="GET" action="{{route('ride.search')}}">
        <div class="mb-6">
            <label for="from_place"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('From place')}}</label>
            <input type="text" id="from_place"
                   value="{{!empty($fromPlace) ? $fromPlace->getName() : $fromPlace}}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Zagreb" required>

            <input
                type="hidden"
                value="{{!empty($fromPlace) ? $fromPlace->getId() : $fromPlace}}"
                name="from_place_id"
                id="from_place_id" required>
        </div>

        <div class="mb-6">
            <label for="to_place"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('To place')}}</label>
            <input type="text" id="to_place"
                   value="{{!empty($toPlace) ? $toPlace->getName() : $toPlace}}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Split" required>

            <input
                type="hidden"
                value="{{!empty($toPlace) ? $toPlace->getId() : $toPlace}}"
                name="to_place_id"
                id="to_place_id" required>
        </div>

        <div class="mb-6">
            <label for="time"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Minimum departure time')}}</label>
            <input type="text"
                   id="time"
                   name="time"
                   readonly
                   value="{{$time}}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class=" mb-6">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{__('Search')}}
            </button>
        </div>

    </form>
</div>
