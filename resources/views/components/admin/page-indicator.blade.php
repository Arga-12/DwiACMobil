@props([
    'title' => '',
    'desc' => '',
    'ctaLabel' => null,
    'ctaHref' => null
])

<!-- Page Indicator Component with Gradient Design -->
<div class="relative overflow-hidden rounded-2xl p-5 sm:p-6 md:p-7 bg-gradient-to-r from-[#0F044C] via-[#141E61] to-[#1D2C90] text-white shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-start gap-3">
            <div>
                <h2 class="font-montserrat-48 text-xl sm:text-2xl md:text-3xl font-bold leading-tight">{{ $title ?? 'Judul Halaman' }}</h2>
                @if(!empty($desc))
                    <p class="mt-1 text-white/85 defparagraf">{{ $desc }}</p>
                @endif
            </div>
        </div>
        @if(!empty($ctaLabel) && !empty($ctaHref))
            <a href="{{ $ctaHref }}" class="inline-flex items-center gap-2 bg-white/95 hover:bg-white text-[#0F044C] px-4 py-2 rounded-lg font-medium transition-colors">
                @if(str_contains(strtolower($ctaLabel), 'kembali'))
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                @else
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                    </svg>
                @endif
                <span>{{ $ctaLabel }}</span>
            </a>
        @endif
    </div>
</div>
