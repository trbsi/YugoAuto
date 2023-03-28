<?php

use App\Source\Ride\Enum\RideFiltersEnum;

?>
<div class="p-2">
    <select id="filter_search" name="dropdown"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="">{{__('Filter')}}</option>
        @foreach(RideFiltersEnum::cases() as $case)
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
