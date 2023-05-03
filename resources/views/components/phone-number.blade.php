<?php
/** @var $user \App\Models\User */

?>
@if(($user->hasPhoneNumber() && $user->isPhoneNumberPublic()) || $forceShow)
    @if($type === 'main')
        <a class="underline"
           href="tel:{{$user->getPhoneNumber()}}">{{$user->getPhoneNumber()}}</a>
        @if($user->isPhoneNumberVerified())
            <i class="fa-solid fa-circle-check" style="color: #2f72e4;"></i>
        @endif
    @elseif($type === 'additional')
        @if ($user->getAdditionalPhonesCollection()->isEmpty())
            {{__('Phone not added')}}
        @else
            @foreach($user->getAdditionalPhonesCollection()->getPhones() as $additionalPhone)
                <div>
                    <a class="underline"
                       href="tel:{{$additionalPhone->getPhoneNumber()}}">{{$additionalPhone->getPhoneNumber()}}</a>
                    @if($additionalPhone->isVerified())
                        <i class="fa-solid fa-circle-check" style="color: #2f72e4;"></i>
                    @endif
                </div>
            @endforeach
        @endif
    @endif
@else
    {{__('Phone not added')}}
@endif
