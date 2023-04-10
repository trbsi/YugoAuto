<x-custom-modal modalClass="appstoreinfo">
    <x-slot name="title">
        {{ __('App available for mobile') }}
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col items-center justify-center">
            {{__('Now you can download this app on your phone')}}
            <a target="_blank" href="{{config('app.android_url')}}">
                <img class="w-1/2 mx-auto my-5" src="{{asset('assets/img/googleplay.png')}}">
            </a>

            <a target="_blank" href="{{config('app.ios_url')}}">
                <img class="w-1/2 mx-auto   " src="{{asset('assets/img/appstore.png')}}">
            </a>
        </div>
    </x-slot>
</x-custom-modal>
