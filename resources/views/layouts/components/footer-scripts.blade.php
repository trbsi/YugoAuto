<?php

use App\Enum\TimeEnum;

?>
<script>
    let areYouSureTitle = '{{__('Are you sure?')}}';
    let transTypeInCity = '{{__('Type in city')}}';
    let citySearchRoute = '{{route('api.place.search')}}';
    let dateTimePickerFormat = '{{TimeEnum::DATETIME_FORMAT->value}}';
    let datePickerFormat = '{{TimeEnum::DATE_FORMAT->value}}';

    //used in mobile app to determine user status
    function isUserAuthenticated() {
        @if(auth()->guest())
            return false;
        @else
            return true;
        @endif
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/custom.js?v=1.32.0')}}"></script>
<script src="{{asset('assets/js/functions.js?v=1.32.0')}}"></script>
@include('components.cookie-consent')
@include('components.google-analytics')
@include('components.toastr')
