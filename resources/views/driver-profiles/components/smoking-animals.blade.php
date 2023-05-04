@if($type==='animals')
    @if($driverProfile->animalsAllowed())
        <x-checkmark type="tick"/>
    @else
        <x-checkmark type="cross"/>
    @endif
@elseif($type === 'smoking')
    @if($driverProfile->smokingAllowed())
        <x-checkmark type="tick"/>
    @else
        <x-checkmark type="cross"/>
    @endif
@endif
