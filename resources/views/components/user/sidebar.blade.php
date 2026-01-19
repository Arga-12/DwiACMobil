<!-- Sidebar Component -->
<aside class="sidebar w-[300px] lg:w-[300px] md:w-[280px] sm:w-[280px] bg-[#F5F5F5] border-r border-gray-200 min-h-screen fixed left-0 top-0 z-40 transform transition-[width,transform] duration-500 ease-[cubic-bezier(0.22,0.61,0.36,1)] will-change-[width,transform] lg:translate-x-0 md:translate-x-0 sm:-translate-x-full">
    <div class="p-3 sm:p-4 md:p-5 lg:p-6 flex flex-col min-h-screen">

        <!-- User Profile -->
        <div class="text-center mb-6 sm:mb-7 md:mb-8 lg:mb-10 pt-4">
            <div class="avatar-lg w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full mx-auto mb-3 sm:mb-4 md:mb-4 lg:mb-5 overflow-hidden shadow-sm">
                @php
                    $user = Auth::user();
                    $profileImage = $user->foto_profil && file_exists(public_path($user->foto_profil))
                        ? asset($user->foto_profil)
                        : null;
                @endphp
                @if($profileImage)
                    <img src="{{ $profileImage }}"
                         alt="User Icon"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    <div class="w-full h-full hidden items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 lg:w-20 lg:h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 lg:w-20 lg:h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                @endif
            </div>
            <h3 class="collapse-hide text-gray-900 bigparagraf text-sm sm:text-base md:text-base lg:text-lg font-bold lowercase mb-1">{{ strtolower(Auth::user()->nama) }}</h3>
            <p class="collapse-hide text-gray-600 defparagraf text-xs sm:text-sm md:text-sm lg:text-base px-2 break-words leading-tight">Bergabung pada<br>{{ Auth::user()->created_at->format('d F Y') }}</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('dashboard*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Dashboard</span>
            </a>

            <!-- Booking Antrian -->
            <a href="{{ route('booking') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('booking*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024"><path fill="currentColor" d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32m-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5"/></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Booking Antrian</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profile') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('profile*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="5"/>
                    <path d="M20 21a8 8 0 0 0-16 0"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Profil</span>
            </a>

            <!-- Manajemen Antrian -->
            <a href="{{ route('antrian') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('antrian*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12a9 9 0 11-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/>
                    <path d="M21 3v5h-5"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Manajemen Antrian</span>
            </a>

            <!-- Notifikasi -->
            <a href="{{ route('notifications') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('notifications*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors relative">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 19v-9a6 6 0 0 1 6-6v0a6 6 0 0 1 6 6v9M6 19h12M6 19H4m14 0h2m-9 3h2"/>
                    <circle cx="12" cy="3" r="1"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Notifikasi</span>
                @php
                    $notificationCount = auth()->check() ? auth()->user()->unreadNotifications()->count() : 0;
                @endphp
                @if($notificationCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $notificationCount }}</span>
                @endif
            </a>
        </nav>

        <!-- Bottom Buttons -->
        <div class="mt-auto pt-4 space-y-2">
            <!-- Divider -->
            <div class="-mx-3 sm:-mx-4 md:-mx-5 lg:-mx-6 h-px bg-black/20 mb-2" aria-hidden="true"></div>

            <!-- Keluar Dashboard Button -->
            <a href="{{ route('beranda') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 rounded-lg text-black bg-white border border-black hover:bg-gray-50 transition-colors w-full">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11l2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1m-6 0h6"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Keluar Dashboard</span>
            </a>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 rounded-lg text-black bg-white border border-black hover:bg-gray-50 transition-colors w-full text-left">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Log out</span>
                </button>
            </form>
        </div>
    </div>
</aside>
