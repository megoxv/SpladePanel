<!DOCTYPE html>
@php
    $languages = \App\Models\Language::where('status', 1)->orderBy('name', 'asc')->get();
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @foreach ($languages as $lang)@if(App::getLocale() == $lang->code) dir="{{ $lang->dir }}" @endif @endforeach>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @spladeHead
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased">
        @splade
    </body>
</html>
