<?php
/** @var $user \App\Models\User */

?>
@if(($user->hasPhoneNumber() && $user->isPhoneNumberPublic()) || $forceShow)
    <a class="underline"
       href="tel:{{$user->getPhoneNumber()}}">{{$user->getPhoneNumber()}}</a>
    @if($user->isPhoneNumberVerified())
        <i class="fa-solid fa-circle-check" style="color: #2f72e4;"></i>
    @endif
@else
    {{__('Phone not added')}}
@endif
