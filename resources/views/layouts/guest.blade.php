<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.components.header')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@livewire('navigation-menu')

<div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
    {{ $slot }}
</div>

@include('layouts.components.footer')
@include('layouts.components.footer-scripts')
@stack('javascript')

</body>
</html>
