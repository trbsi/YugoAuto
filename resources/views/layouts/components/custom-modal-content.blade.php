<x-custom-modal modalClass="multiple-numbers-cars">
    <x-slot name="title">
        {{ __('New features additional cars and phones') }}
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col items-center justify-center">
            {!! __('New features additional cars and phones description') !!}
            <x-slot name="link" :url="route('profile.show')" :linkText="__('Click here')">
            </x-slot>
        </div>
    </x-slot>
</x-custom-modal>

@if(!is_country_chosen())
    <x-custom-modal modalClass="choose-country">
        <x-slot name="title">
            {{ __('Choose country') }}
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-wrap">
                @foreach(get_available_countries() as $enName => $nativeName)
                    <div class="w-1/2 p-2">
                        <a class="underline" href="{{change_country_url($enName)}}">{{$nativeName}}</a>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-custom-modal>
@endif
