@if($phoneNumber && $isPhoneNumberPublic)
    <a class="underline"
       href="tel:{{$phoneNumber}}">{{$phoneNumber}}</a>
@else
    {{__('Phone not added')}}
@endif
