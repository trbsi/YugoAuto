@if ($shorthand === true)
    @php
        $animalsAllowedString = __('Animals allowed shorthand');
        $smokingAllowedString =__('Smoking allowed shorthand');
    @endphp

@else
    @php
        $animalsAllowedString = __('Animals allowed');
        $smokingAllowedString =__('Smoking allowed');
    @endphp
@endif


<div>
    @if($driverProfile->animalsAllowed())
        <i class="fa-solid fa-circle-check"
           style="color: #008f02;"></i>
    @else
        <i class="fa-sharp fa-solid fa-circle-xmark" style="color: #bd0000;"></i>
    @endif
    {{$animalsAllowedString}}
</div>
<div>
    @if($driverProfile->smokingAllowed())
        <i class="fa-solid fa-circle-check"
           style="color: #008f02;"></i>
    @else
        <i class="fa-sharp fa-solid fa-circle-xmark" style="color: #bd0000;"></i>
    @endif
    {{$smokingAllowedString}}
</div>
