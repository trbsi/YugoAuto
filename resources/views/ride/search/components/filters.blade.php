<?php

use App\Source\Ride\Enum\RideExtraFiltersEnum;

?>
<div class="p-2">
    <select id="filter_search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="">{{__('Filter')}}</option>
        @foreach(RideExtraFiltersEnum::cases() as $case)
            <option
                value="{{$case->value}}"
                @if(request()->query('filter') === $case->value) selected @endif>
                {{__('Filter - ' . $case->value)}}
            </option>
        @endforeach

    </select>
</div>

@push('javascript')
    <script>
        var baseQueryString = '{{build_ride_search_base_query()}}';
        baseQueryString = baseQueryString.replace(/&amp;/g, "&");
        var urlWithBaseFilters = '{{request()->url()}}?' + baseQueryString;

        $('#filter_search').change(function () {

            var value = $(this).val();
            if (value === '') {
                window.location = urlWithBaseFilters;
                return;
            }
            window.location = urlWithBaseFilters + '&filter=' + value;
        })
    </script>
@endpush
