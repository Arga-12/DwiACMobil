<!-- Sidebar Component -->
<aside class="w-[300px] lg:w-[300px] md:w-[280px] sm:w-[280px] bg-[#EEEEEE] border-r border-[#0F044C] min-h-screen fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out transform lg:translate-x-0 md:translate-x-0 sm:-translate-x-full">
    <div class="p-3 sm:p-4 md:p-5 lg:p-6 flex flex-col min-h-screen">
        <!-- User Profile -->
        <div class="text-center mb-4 sm:mb-5 md:mb-6 lg:mb-8">
            <div class="w-14 h-14 sm:w-16 sm:h-16 md:w-18 md:h-18 lg:w-20 lg:h-20 mt-[70px] bg-gray-300 rounded-full mx-auto mb-2 sm:mb-3 md:mb-3 lg:mb-4 overflow-hidden">
                @php
                    $user = Auth::user();
                    $profileImage = $user->profile_photo && file_exists(public_path($user->profile_photo)) 
                        ? $user->profile_photo 
                        : 'images/user/yui.jpg';
                @endphp
                <img src="{{ asset($profileImage) }}" 
                     alt="User Icon"
                     class="w-full h-full object-cover"
                     onerror="this.src='{{ asset('images/user/yui.jpg') }}'" />
            </div>                        
            <h3 class="text-gray-900 bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">{{ Auth::user()->nama }}</h3>
            <p class="text-gray-600 defparagraf text-xs sm:text-xs md:text-xs lg:text-sm whitespace-nowrap">Bergabung pada {{ Auth::user()->created_at->format('d F Y') }}</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1 sm:space-y-2 md:space-y-2 lg:space-y-3">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('dashboard') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                    <path fill="currentColor" fill-rule="evenodd" d="M.125 3.25a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M10.75.125a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25M8.875 3.25a1.875 1.875 0 1 1 3.75 0a1.875 1.875 0 0 1-3.75 0m-8.75 7.5a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M3.25 8.875a1.875 1.875 0 1 0 0 3.75a1.875 1.875 0 0 0 0-3.75m7.5-1.25a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25" clip-rule="evenodd"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Dashboard</span>
            </a>
            
            <a href="{{ route('booking') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('booking*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                    <path fill="currentColor" d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32m-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Booking Antrian</span>
            </a>
            
            <a href="{{ route('profile') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('profile*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Profil</span>
            </a>
            
            <a href="{{ route('history') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('history*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Histori Antrian</span>
            </a>
            
            <a href="{{ route('notifications') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('notifications*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors relative">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 19v-9a6 6 0 0 1 6-6v0a6 6 0 0 1 6 6v9M6 19h12M6 19H4m14 0h2m-9 3h2"/><circle cx="12" cy="3" r="1"/></g>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Notifikasi</span>
                @php
                    $notificationCount = (Auth::user()->id_pelanggan % 5) + 1; // Dynamic notification count
                @endphp
                @if($notificationCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $notificationCount }}</span>
                @endif
            </a>
        </nav>

        <!-- Bottom Buttons -->
        <div class="mt-auto pt-4 space-y-2">
            <!-- Keluar Dashboard Button -->
            <a href="{{ route('beranda') }}" 
            class="flex items-center space-x-2 w-full px-4 py-2 text-black bg-[#EEEEEE]">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path fill="currentColor" d="m12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81zM12 3L2 12h3v8h6v-6h2v6h6v-8h3"/>
                </svg>
                <span class="bigparagraf text-sm sm:text-base">Keluar Dashboard</span>
            </a>

            <!-- Divider -->
            <div class="-mx-3 sm:-mx-4 md:-mx-5 lg:-mx-6 h-px bg-[#0F044C]" aria-hidden="true"></div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center space-x-2 w-full px-4 py-2 text-black bg-[#EEEEEE]">
                    <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M15.5 16.5L20 12l-4.5-4.5m3.25 4.5H9m0 8.5H4v-17h5"/>
                    </svg>
                    <span class="bigparagraf text-sm sm:text-base">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>