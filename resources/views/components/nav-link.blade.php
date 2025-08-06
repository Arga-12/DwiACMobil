@props(['active' => false, 'href' => '#', 'type' => 'a'])

@if ($type == 'a')
<a href="{{ $href }}" class="text-lg font-medium text-white hover:text-gray-200 transition relative group" aria-current={{ $active ? 'page' : 'false' }}>
    {{ $slot }}
    <span class="{{ $active ? 'absolute -top-9 left-1/2 transform -translate-x-1/2 w-full h-2 bg-white rounded-full' : 'hidden' }}"></span>
</a>
@else
<button href="{{ $href }}" class="text-lg font-medium text-white hover:text-gray-200 transition relative group" aria-current={{ $active ? 'page' : 'false' }}>
    {{ $slot }}
    <span class="{{ $active ? 'absolute -top-9 left-1/2 transform -translate-x-1/2 w-full h-2 bg-white rounded-full' : 'hidden' }}"></span>
</button>
@endif