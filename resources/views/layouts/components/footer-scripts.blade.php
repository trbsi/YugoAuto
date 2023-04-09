<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/custom.js?v=1.11.0')}}"></script>
<script src="{{asset('assets/js/functions.js?v=1.11.0')}}"></script>
@include('components.cookie-consent')
@include('components.google-analytics')
@include('components.toastr')
<script>
    let areYouSureTitle = '{{__('Are you sure?')}}';

    function isUserAuthenticated() {
        @if(auth()->guest())
            return false;
        @else
            return true;
        @endif
    }
</script>
