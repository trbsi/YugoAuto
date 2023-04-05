@component('mail::message')
{{__('Hello')}}

{!! $body !!}

@if(isset($buttonUrl) && !empty($buttonUrl))
@component('mail::button', ['url' => $buttonUrl])
{{$buttonText}}
@endcomponent
@endif

"{{ config('app.name') }}"
@endcomponent
