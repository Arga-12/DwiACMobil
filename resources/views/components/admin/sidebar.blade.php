<!-- Admin Sidebar Component -->
@vite('resources/js/admin/sidebar-transisi.js')
<style>
    .sidebar-mode-section {
        transition: opacity 300ms ease-in-out, max-height 300ms ease-in-out;
        overflow: hidden;
    }
    .sidebar-mode-section.hidden {
        display: none;
    }
</style>
<aside class="sidebar w-[300px] lg:w-[300px] md:w-[280px] sm:w-[280px] bg-[#F5F5F5] border-r border-gray-200 min-h-screen fixed left-0 top-0 z-40 transform transition-[width,transform] duration-500 ease-[cubic-bezier(0.22,0.61,0.36,1)] will-change-[width,transform] lg:translate-x-0 md:translate-x-0 sm:-translate-x-full">
    <div class="p-3 sm:p-4 md:p-5 lg:p-6 flex flex-col min-h-screen">
        <!-- Admin Profile -->
        <div class="text-center mb-6 sm:mb-7 md:mb-8 lg:mb-10 pt-4">
            <div class="avatar-lg w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full mx-auto mb-3 sm:mb-4 md:mb-4 lg:mb-5 overflow-hidden shadow-sm">
                @php
                    $adminAuth = auth()->guard('montir')->user() ?? auth()->user();
                    $adminPhoto = ($adminAuth && !empty($adminAuth->foto) && file_exists(public_path($adminAuth->foto)))
                        ? asset($adminAuth->foto)
                        : null;
                @endphp
                @if($adminPhoto)
                    <img src="{{ $adminPhoto }}"
                         alt="Admin Icon"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    <div class="w-full h-full hidden items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 lg:w-20 lg:h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 lg:w-20 lg:h-20 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                @endif
            </div>
            <h3 class="collapse-hide text-gray-900 bigparagraf text-sm sm:text-base md:text-base lg:text-lg font-bold lowercase mb-1">{{ $adminAuth ? strtolower(($adminAuth->peran ? ucfirst($adminAuth->peran).' - ' : '') . ($adminAuth->nama ?? 'Admin')) : 'admin' }}</h3>
            <p class="collapse-hide text-gray-600 defparagraf text-xs sm:text-sm md:text-sm lg:text-base px-2 break-words leading-tight">
                @if($adminAuth && $adminAuth->created_at)
                    Bergabung pada<br>{{ $adminAuth->created_at->format('d F Y') }}
                @else
                    &nbsp;
                @endif
            </p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-2">
            <!-- Notifikasi (moved from header) -->
            <a href="{{ route('admin.notifications') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.notifications*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors relative">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 19v-9a6 6 0 0 1 6-6v0a6 6 0 0 1 6 6v9M6 19h12M6 19H4m14 0h2m-9 3h2"/>
                    <circle cx="12" cy="3" r="1"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Notifikasi</span>
                @php
                    $adminAuth = auth()->guard('montir')->user() ?? auth()->user();
                    $adminNotificationCount = $adminAuth ? $adminAuth->unreadNotifications()->count() : 0;
                @endphp
                @if($adminNotificationCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $adminNotificationCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.dashboard') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.profil-admin') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.profil-admin') || request()->routeIs('admin.profile*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="5"/>
                    <path d="M20 21a8 8 0 0 0-16 0"/>
                </svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Profil</span>
            </a>

            <!-- Bengkel Section (Mode-based) -->
            <div id="sidebar-bengkel-section" class="sidebar-mode-section space-y-2">
              <a href="{{ route('admin.antrian') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.antrian*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024"><path fill="currentColor" d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32m-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5"/></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Antrian</span>
              </a>
              <a href="{{ route('admin.layanan') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.layanan*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="currentColor" d="M7 5a4 4 0 0 1 5.445-3.73a.5.5 0 0 1 .173.819L10.707 4L12 5.293l1.91-1.91a.5.5 0 0 1 .82.172a4 4 0 0 1-4.829 5.292L4.896 13.92a1.986 1.986 0 0 1-2.842-2.774l5.05-5.234A4 4 0 0 1 7 5m4-3a3 3 0 0 0-2.862 3.903a.5.5 0 0 1-.117.498L2.773 11.84a.986.986 0 0 0 1.41 1.377l5.225-5.293a.5.5 0 0 1 .532-.116a3 3 0 0 0 4.046-3.088l-1.633 1.634a.5.5 0 0 1-.707 0l-2-2a.5.5 0 0 1 0-.707l1.634-1.634A3 3 0 0 0 11 2"/></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Layanan</span>
              </a>
            </div>

            <!-- Website Section (Mode-based) -->
            <div id="sidebar-website-section" class="sidebar-mode-section hidden opacity-0 space-y-2">
              <a href="{{ route('admin.artikel.index') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.artikel*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"/><path d="M6 12c0-1.414 0-2.121.44-2.56C6.878 9 7.585 9 9 9h6c1.414 0 2.121 0 2.56.44c.44.439.44 1.146.44 2.56v4c0 1.414 0 2.121-.44 2.56c-.439.44-1.146.44-2.56.44H9c-1.414 0-2.121 0-2.56-.44C6 18.122 6 17.415 6 16z"/><path stroke-linecap="round" d="M7 6h5"/></g></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Artikel</span>
              </a>
              <a href="{{ route('admin.montir.index') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.montir*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Montir</span>
              </a>
              <a href="{{ route('admin.galeri.index') }}" class="flex nav-link items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-3 sm:px-3 md:px-3 lg:px-4 py-2.5 lg:py-3 rounded-lg {{ request()->routeIs('admin.galeri*') ? 'text-white bg-[#1D2C90] border-none' : 'text-black bg-white border border-black' }} transition-colors">
                <svg class="w-6 h-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 14c0-3.771 0-5.657 1.172-6.828S6.229 6 10 6h4c3.771 0 5.657 0 6.828 1.172S22 10.229 22 14s0 5.657-1.172 6.828S17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.172S2 17.771 2 14Z"/><path d="m4 7l-.012-1c.112-.931.347-1.574.837-2.063C5.765 3 7.279 3 10.307 3h3.211c3.028 0 4.541 0 5.482.937c.49.489.725 1.132.837 2.063v1"/><circle cx="17.5" cy="10.5" r="1.5"/><path stroke-linecap="round" d="m2 14.5l1.752-1.533a2.3 2.3 0 0 1 3.14.105l4.29 4.29a2 2 0 0 0 2.564.222l.299-.21a3 3 0 0 1 3.731.225L21 20.5"/></g></svg>
                <span class="collapse-hide bigparagraf text-xs sm:text-sm md:text-sm lg:text-base font-medium">Galeri</span>
              </a>
            </div>
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto pt-4 space-y-2">
            <!-- Divider -->
            <div class="-mx-3 sm:-mx-4 md:-mx-5 lg:-mx-6 h-px bg-black/20 mb-2" aria-hidden="true"></div>
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

<!-- Sidebar dropdown helper -->
<script>
  if (typeof window.toggleSidebarSection !== 'function') {
    function isAnimating(el) {
      return el.dataset.animating === 'true';
    }
    function setAnimating(el, val) {
      el.dataset.animating = val ? 'true' : 'false';
    }
    function prepareTransition(el) {
      // Ensure we only transition the properties we animate
      el.style.transitionProperty = 'max-height, opacity';
      // Respect existing timing from Tailwind classes
      // (duration-500/ease-in-out on the element)
      el.style.willChange = 'max-height, opacity';
      el.style.overflow = 'hidden';
    }
    function cleanupTransition(el) {
      el.style.transitionProperty = '';
      el.style.willChange = '';
      el.style.overflow = '';
    }

    function slideDown(el, chevron) {
      if (isAnimating(el)) return;
      setAnimating(el, true);

      el.classList.remove('hidden');
      prepareTransition(el);
      // Start from 0
      el.style.maxHeight = '0px';
      el.style.opacity = '0';

      requestAnimationFrame(function() {
        // Measure target height and animate towards it
        el.style.maxHeight = el.scrollHeight + 'px';
        el.style.opacity = '1';
      });

      // Rotate chevron up
      if (chevron) chevron.classList.remove('rotate-180');

      var onEnd = function(e) {
        if (e.propertyName !== 'max-height') return;
        // Allow content to grow naturally after opening
        el.style.maxHeight = '';
        el.style.opacity = '';
        cleanupTransition(el);
        setAnimating(el, false);
        el.removeEventListener('transitionend', onEnd);
      };
      el.addEventListener('transitionend', onEnd);
    }

    function slideUp(el, chevron) {
      if (isAnimating(el)) return;
      setAnimating(el, true);

      prepareTransition(el);
      // Stabilize the start height to avoid jumpy collapse
      var currentHeight = el.getBoundingClientRect().height;
      el.style.maxHeight = currentHeight + 'px';
      el.style.opacity = '1';

      // In next frame, animate to 0
      requestAnimationFrame(function() {
        el.style.maxHeight = '0px';
        el.style.opacity = '0';
      });

      // Rotate chevron down
      if (chevron) chevron.classList.add('rotate-180');

      var onEnd = function(e) {
        if (e.propertyName !== 'max-height') return;
        el.classList.add('hidden');
        // Clear inline styles to avoid affecting future animations
        el.style.maxHeight = '';
        el.style.opacity = '';
        cleanupTransition(el);
        setAnimating(el, false);
        el.removeEventListener('transitionend', onEnd);
      };
      el.addEventListener('transitionend', onEnd);
    }

    window.toggleSidebarSection = function(sectionId, chevronId) {
      var el = document.getElementById(sectionId);
      var chevron = document.getElementById(chevronId);
      if (!el || !chevron) return;

      // Prevent toggling while animating for smoother UX
      if (isAnimating(el)) return;

      var isHidden = el.classList.contains('hidden');
      if (isHidden) {
        slideDown(el, chevron);
      } else {
        slideUp(el, chevron);
      }
    }
  }

</script>

<!-- Alpine.js (CDN) for dropdown animation -->
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
