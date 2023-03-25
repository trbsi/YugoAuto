@component('mail::message')
Hello

{!! $body !!}

@if(isset($buttonUrl))
@component('mail::button', ['url' => $buttonUrl])
{{$buttonText}}
@endcomponent
@endif

Thanks,
"{{ config('app.name') }}"
@endcomponent
