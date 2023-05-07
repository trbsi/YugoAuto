@if($attributes['role'] === 'warning')
    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-yellow-800 dark:text-yellow-300"
         role="alert">
        {{$content}}
        @if(isset($link))
            <a href="{{$link}}" class="underline font-bold">{{__('Click here')}}</a>
        @endif
    </div>
@endif

@if($attributes['role'] === 'info')
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-800 dark:text-blue-400" role="alert">
        {{$content}}
        @if(isset($link))
            <a href="{{$link}}" class="underline font-bold">{{__('Click here')}}</a>
        @endif
    </div>
@endif

@if($attributes['role'] === 'danger')
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400" role="alert">
        {{$content}}
        @if(isset($link))
            <a href="{{$link}}" class="underline font-bold">{{__('Click here')}}</a>
        @endif
    </div>
@endif

@if($attributes['role'] === 'success')
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-400"
         role="alert">
        {{$content}}
        @if(isset($link))
            <a href="{{$link}}" class="underline font-bold">{{__('Click here')}}</a>
        @endif
    </div>
@endif
