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
        <x-checkmark type="tick"/>
    @else
        <x-checkmark type="cross"/>
    @endif
    {{$animalsAllowedString}}
</div>
<div>
    @if($driverProfile->smokingAllowed())
        <x-checkmark type="tick"/>
    @else
        <x-checkmark type="cross"/>
    @endif
    {{$smokingAllowedString}}
</div>
