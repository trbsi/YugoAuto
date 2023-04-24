<x-custom-modal modalClass="newcities-and-lastmincancel">
    <x-slot name="title">
        {{ __('New features') }}
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col items-center justify-center">
            {!! __('New features text') !!}
        </div>
    </x-slot>
</x-custom-modal>

<x-custom-modal modalClass="package-and-passenger-restriction">
    <x-slot name="title">
        {{ __('New features') }}
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col items-center justify-center">
            {!! __('New features text for accepting package and passenger restriction') !!}
        </div>
    </x-slot>
</x-custom-modal>

@if(!auth()->guest())
    <x-custom-modal modalClass="driverprofile">
        <x-slot name="title">
            {{ __('Update your driver profile') }}
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col items-center justify-center">
                {{__('Now you can update your driver profile')}}
                <x-slot name="link" :url="route('profile.show')" :linkText="__('Click here to update driver profile')">
                </x-slot>
            </div>
        </x-slot>
    </x-custom-modal>
@endif
