<?php
/** @var \App\Models\Place $fromPlace */

/** @var \Illuminate\Database\Eloquent\Collection $toPlaces */
?>
<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <form method="GET" action="{{route('ride.search')}}">
        <div class="mb-6">
            <label for="from_place"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('From place')}}
                <i>({{__('Required')}})</i></label>
            <input type="text"
                   id="from_place"
                   class="clear-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Zagreb" required>

            <input
                type="hidden"
                value="{{!empty($fromPlace) ? $fromPlace->getId() : $fromPlace}}"
                name="from_place_id"
                id="from_place_id" required>
        </div>
        <div class="mb-6">
            <button type="button" id="switch_rides"
                    class="w-full py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                {{__('Switch cities')}} &#8593;&#8595;
            </button>
        </div>

        <div class="mb-6">
            <label for="to_place"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('To place')}}
                <i>({{__('Required')}})</i></label>
            <div class="text-sm italic">{{__('You can choose up to 5 cities as your destination')}}</div>
            <input type="text"
                   id="to_place"
                   class="clear-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="Split" required>

            <input
                type="hidden"
                value="{{$toPlaces->isNotEmpty() ? implode(',', $toPlaces->pluck('id')->toArray()) : null}}"
                name="to_place_id"
                id="to_place_id" required>
        </div>

        <div class="mb-6">
            <label for="time"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Minimum departure time')}}
                <i>({{__('Optional')}})</i></label>
            <input type="text"
                   name="min_time"
                   readonly
                   value="{{$minTime}}"
                   class="datepicker clear-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="time"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Maximum departure time')}}
                <i>({{__('Optional')}})</i></label>
            <input type="text"
                   name="max_time"
                   readonly
                   value="{{$maxTime}}"
                   class="datepicker clear-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="is_accepting_package"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Rides that accept packages')}}
                <i>({{__('Optional')}})</i></label>
            <x-input type="checkbox"
                     :checked='$isAcceptingPackage'
                     name="is_accepting_package"/>
        </div>

        <div class=" mb-6">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{__('Search')}}
            </button>
        </div>

        <div class=" mb-6">
            <a href="{{route('home')}}"
               class="w-full block text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                {{__('Reset')}}
            </a>
        </div>

    </form>
</div>

@push('javascript')
    <script>
        $(function () {
            @if(!empty($fromPlace))
            $('#from_place').tokenInput('add', {id: {{$fromPlace->getId()}}, name: '{{$fromPlace->getName()}}'});
            @endif


            @if($toPlaces->isNotEmpty())
            var tmpToPlaceIds = [
                    @foreach($toPlaces as $toPlace)
                {
                    id: {{$toPlace->getId()}}, name: '{{$toPlace->getName()}}'
                },
                @endforeach
            ];

            tmpToPlaceIds.forEach(function (element) {
                $('#to_place').tokenInput('add', element);
            })
            @endif
        });
    </script>
@endpush
