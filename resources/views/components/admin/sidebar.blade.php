<!-- Admin Sidebar Component -->
<aside class="w-[300px] lg:w-[300px] md:w-[280px] sm:w-[280px] bg-[#EEEEEE] border-r border-[#0F044C] min-h-screen fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out transform lg:translate-x-0 md:translate-x-0 sm:-translate-x-full">
    <div class="p-3 sm:p-4 md:p-5 lg:p-6">
        <!-- Admin Profile -->
        <div class="text-center mb-4 sm:mb-5 md:mb-6 lg:mb-8">
            <div class="w-14 h-14 sm:w-16 sm:h-16 md:w-18 md:h-18 lg:w-20 lg:h-20 mt-[70px] bg-gray-300 rounded-full mx-auto mb-2 sm:mb-3 md:mb-3 lg:mb-4 overflow-hidden">
                <img src="{{ asset('images/admin/admin1.jpg') }}" 
                     alt="Admin Icon"
                     class="w-full h-full object-cover" />
            </div>                        
            <h3 class="text-gray-900 bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Admin - Brian O'Connor</h3>
            <p class="text-gray-600 defparagraf text-xs sm:text-xs md:text-xs lg:text-sm whitespace-nowrap">Bergabung pada 01 September 2025</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1 sm:space-y-2 md:space-y-2 lg:space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.dashboard') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                    <path fill="currentColor" fill-rule="evenodd" d="M.125 3.25a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M10.75.125a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25M8.875 3.25a1.875 1.875 0 1 1 3.75 0a1.875 1.875 0 0 1-3.75 0m-8.75 7.5a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M3.25 8.875a1.875 1.875 0 1 0 0 3.75a1.875 1.875 0 0 0 0-3.75m7.5-1.25a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25" clip-rule="evenodd"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.antrian') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.antrian*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                    <path fill="currentColor" d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32m-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Manajemen Antrian</span>
            </a>
            
            <a href="{{ route('admin.layanan') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.layanan*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Layanan</span>
            </a>
            
            <a href="{{ route('admin.galeri.index') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.galeri*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Galeri</span>
            </a>
            
            <a href="{{ route('admin.montir.index') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.montir*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Montir</span>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto pt-4 sm:pt-5 md:pt-6 lg:pt-8">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 text-red-600 bg-[#EEEEEE] border-2 border-red-600 hover:text-white hover:bg-red-600 hover:border-red-600 transition-colors">
                    <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                    </svg>
                    <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
