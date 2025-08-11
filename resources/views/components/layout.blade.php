<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dwi AC Mobil' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
</head>
<body class="{{ (isset($showHeader) && $showHeader && (!isset($showHero) || !$showHero)) ? 'pt-24' : '' }}">
<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->

@if(isset($showHeader) && $showHeader)
    <x-header />
@endif

@if(isset($showHero) && $showHero)
    <x-hero>
        @if(isset($heroHeading))
            <x-slot name="heading">{{ $heroHeading }}</x-slot>
        @endif
        @if(isset($heroContent))
            {{ $heroContent }}
        @endif
    </x-hero>
@endif

{{ $slot }}

</body>
</html>