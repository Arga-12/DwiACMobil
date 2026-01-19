@props([
    'solidHeaderAtTop' => false,
    'showHeader' => false,
    'showHero' => false,
    'heroData' => [],
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/artikel_layanan/likes.js'])
    <title>Dwi AC Mobil</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
    @vite('resources/js/app.js')
</head>
<body>
<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->

@if($showHeader)
    <x-header :solidAtTop="$solidHeaderAtTop" />
@endif

@if(isset($showHero) && $showHero)
    <x-hero :heroData="$heroData ?? []">
        @if(isset($heroHeading))
            <x-slot name="heading">{{ $heroHeading }}</x-slot>
        @endif
        @if(isset($heroContent))
            {{ $heroContent }}
        @endif
    </x-hero>
@endif

{{ $slot }}

<x-footer />

</body>
</html>
