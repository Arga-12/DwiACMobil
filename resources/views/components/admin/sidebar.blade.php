<!-- Admin Sidebar Component -->
<aside class="w-[300px] lg:w-[300px] md:w-[280px] sm:w-[280px] bg-[#EEEEEE] border-r border-[#0F044C] min-h-screen fixed left-0 top-0 z-40 transition-all duration-300 ease-in-out transform lg:translate-x-0 md:translate-x-0 sm:-translate-x-full">
    <div class="p-3 sm:p-4 md:p-5 lg:p-6 flex flex-col min-h-screen">
        <!-- Admin Profile -->
        <div class="text-center mb-4 sm:mb-5 md:mb-6 lg:mb-8">
            <div class="w-14 h-14 sm:w-16 sm:h-16 md:w-18 md:h-18 lg:w-20 lg:h-20 mt-[70px] bg-gray-300 rounded-full mx-auto mb-2 sm:mb-3 md:mb-3 lg:mb-4 overflow-hidden">
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
                    <div class="w-full h-full hidden items-center justify-center">
                        <svg class="w-10 h-10 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g>
                        </svg>
                    </div>
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g>
                        </svg>
                    </div>
                @endif
             </div>
            <h3 class="text-gray-900 bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">
                {{ $adminAuth ? (($adminAuth->peran ? ucfirst($adminAuth->peran).' - ' : '') . ($adminAuth->nama ?? 'Admin')) : 'Admin' }}
            </h3>
            <p class="text-gray-600 defparagraf text-xs sm:text-xs md:text-xs lg:text-sm whitespace-nowrap">
                @if($adminAuth && $adminAuth->created_at)
                    Bergabung pada {{ $adminAuth->created_at->format('d F Y') }}
                @else
                    &nbsp;
                @endif
            </p>
         </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1 sm:space-y-2 md:space-y-2 lg:space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.dashboard') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                    <path fill="currentColor" fill-rule="evenodd" d="M.125 3.25a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M10.75.125a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25M8.875 3.25a1.875 1.875 0 1 1 3.75 0a1.875 1.875 0 0 1-3.75 0m-8.75 7.5a3.125 3.125 0 1 1 6.25 0a3.125 3.125 0 0 1-6.25 0M3.25 8.875a1.875 1.875 0 1 0 0 3.75a1.875 1.875 0 0 0 0-3.75m7.5-1.25a3.125 3.125 0 1 0 0 6.25a3.125 3.125 0 0 0 0-6.25" clip-rule="evenodd"/>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Dashboard</span>
            </a>
            <a href="{{ route('admin.profil-admin') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.profile*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black bg-[#EEEEEE] border-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }} transition-colors">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g>
                </svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Profil</span>
            </a>
            
            @php
              $mgActive = request()->routeIs('admin.antrian*') || request()->routeIs('admin.layanan*');
              $webActive = request()->routeIs('admin.galeri*') || request()->routeIs('admin.montir*') || request()->routeIs('admin.artikel*');
            @endphp
            <div class="border-2 {{ $mgActive ? 'border-[#787A91] bg-[#787A91] text-[#EEEEEE]' : 'border-black bg-[#EEEEEE] text-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }}">
              <button type="button" onclick="toggleSidebarSection('mg-section', 'mg-chevron')" class="w-full flex items-center justify-between space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3  transition-colors">
                <span class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3">
                  <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="M6 1a1.75 1.75 0 0 0-1.75 1.75V4H3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.25V2.75A1.75 1.75 0 0 0 10 1zm4.25 3V2.75A.25.25 0 0 0 10 2.5H6a.25.25 0 0 0-.25.25V4zM3 5.5h10a.5.5 0 0 1 .5.5v1h-11V6a.5.5 0 0 1 .5-.5m-.5 3V13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8.5H9V10H7V8.5z" clip-rule="evenodd"/></svg>
                  <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Bengkel</span>
                </span>
                <svg id="mg-chevron" class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5 transform transition-transform duration-300 ease-in-out rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024"><path fill="currentColor" d="m488.832 344.32l-339.84 356.672a32 32 0 0 0 0 44.16l.384.384a29.44 29.44 0 0 0 42.688 0l320-335.872l319.872 335.872a29.44 29.44 0 0 0 42.688 0l.384-.384a32 32 0 0 0 0-44.16L535.168 344.32a32 32 0 0 0-46.336 0"/></svg>
              </button>
            </div>
            
            <!-- Dropdown Items as Full Buttons -->
            <div id="mg-section" class="hidden overflow-hidden transition-all duration-500 ease-in-out space-y-5">
              <a href="{{ route('admin.antrian') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.antrian*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black border-b-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-b-2 hover:border-[#787A91]' }} transition-all duration-300 ease-in-out">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5 transform transition-transform duration-300 ease-in-out" xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 1024 1024"><path fill="currentColor" d="M928 224H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32m-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120zM416 496H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m0 136H232c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8m308.2-177.4L620.6 598.3l-52.8-73.1c-3-4.2-7.8-6.6-12.9-6.6H500c-6.5 0-10.3 7.4-6.5 12.7l114.1 158.2a15.9 15.9 0 0 0 25.8 0l165-228.7c3.8-5.3 0-12.7-6.5-12.7H737c-5-.1-9.8 2.4-12.8 6.5"/></svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Antrian</span>
              </a>
              <a href="{{ route('admin.layanan') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.layanan*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black border-b-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-b-2 hover:border-[#787A91]' }} transition-all duration-300 ease-in-out">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="currentColor" d="M7 5a4 4 0 0 1 5.445-3.73a.5.5 0 0 1 .173.819L10.707 4L12 5.293l1.91-1.91a.5.5 0 0 1 .82.172a4 4 0 0 1-4.829 5.292L4.896 13.92a1.986 1.986 0 0 1-2.842-2.774l5.05-5.234A4 4 0 0 1 7 5m4-3a3 3 0 0 0-2.862 3.903a.5.5 0 0 1-.117.498L2.773 11.84a.986.986 0 0 0 1.41 1.377l5.225-5.293a.5.5 0 0 1 .532-.116a3 3 0 0 0 4.046-3.088l-1.633 1.634a.5.5 0 0 1-.707 0l-2-2a.5.5 0 0 1 0-.707l1.634-1.634A3 3 0 0 0 11 2"/></svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Layanan</span>
              </a>
            </div>
            
            <!-- Website Dropdown -->
            @php
              // Determine active state based on Website-related routes
              // Already set above, but keep this for clarity if block moves
              $webActive = isset($webActive) ? $webActive : (request()->routeIs('admin.galeri*') || request()->routeIs('admin.montir*') || request()->routeIs('admin.artikel*'));
            @endphp
            <div class="border-2 {{ $webActive ? 'border-[#787A91] bg-[#787A91] text-[#EEEEEE]' : 'border-black bg-[#EEEEEE] text-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-transparent' }}">
              <button type="button" onclick="toggleSidebarSection('web-section', 'web-chevron')" class="w-full flex items-center justify-between space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3  transition-colors">
                <span class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3">
                  <!-- Globe Icon for Website -->
                  <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12a10 10 0 1 1-20.001 0A10 10 0 0 1 22 12Z"/><path d="M16 12c0 1.313-.104 2.614-.305 3.827c-.2 1.213-.495 2.315-.867 3.244c-.371.929-.812 1.665-1.297 2.168c-.486.502-1.006.761-1.531.761s-1.045-.259-1.53-.761c-.486-.503-.927-1.24-1.298-2.168c-.372-.929-.667-2.03-.868-3.244A23.6 23.6 0 0 1 8 12c0-1.313.103-2.614.304-3.827s.496-2.315.868-3.244c.371-.929.812-1.665 1.297-2.168C10.955 2.26 11.475 2 12 2s1.045.259 1.53.761c.486.503.927 1.24 1.298 2.168c.372.929.667 2.03.867 3.244C15.897 9.386 16 10.687 16 12Z"/><path stroke-linecap="round" d="M2 12h20"/></g></svg>
                  <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Website</span>
                </span>
                <svg id="web-chevron" class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5 transform transition-transform duration-300 ease-in-out rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024"><path fill="currentColor" d="m488.832 344.32l-339.84 356.672a32 32 0 0 0 0 44.16l.384.384a29.44 29.44 0 0 0 42.688 0l320-335.872l319.872 335.872a29.44 29.44 0 0 0 42.688 0l.384-.384a32 32 0 0 0 0-44.16L535.168 344.32a32 32 0 0 0-46.336 0"/></svg>
              </button>
            </div>
            <!-- Website Dropdown Items -->
            <div id="web-section" class="hidden overflow-hidden transition-all duration-500 ease-in-out space-y-5">
              <a href="{{ route('admin.artikel.index') }}" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.artikel*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black border-b-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-b-2 hover:border-[#787A91]' }} transition-all duration-300 ease-in-out">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2"/></svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Artikel</span>
              </a>
              <a href="#" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.montir*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black border-b-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-b-2 hover:border-[#787A91]' }} transition-all duration-300 ease-in-out">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g></svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Montir</span>
              </a>
              <a href="#" class="flex items-center space-x-2 sm:space-x-2 md:space-x-3 lg:space-x-3 px-2 sm:px-3 md:px-3 lg:px-4 py-2 lg:py-3 {{ request()->routeIs('admin.galeri*') ? 'text-[#EEEEEE] bg-[#787A91] border-2 border-[#787A91]' : 'text-black border-b-2 border-black hover:text-[#EEEEEE] hover:bg-[#787A91] hover:border-b-2 hover:border-[#787A91]' }} transition-all duration-300 ease-in-out">
                <svg class="w-4 h-4 sm:w-4 sm:h-4 md:w-4 md:h-4 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M4 3a2 2 0 0 0-2 2v14l4-4h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm12 12H4l4-8l3 6l2-4l3 6z"/></svg>
                <span class="bigparagraf text-xs sm:text-sm md:text-sm lg:text-base">Galeri</span>
              </a>
            </div>
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto pt-4 space-y-2">
            <!-- Divider -->
            <div class="-mx-3 sm:-mx-4 md:-mx-5 lg:-mx-6 h-px bg-[#0F044C]" aria-hidden="true"></div>
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
  
  // Initialize dropdown states on page load
  document.addEventListener('DOMContentLoaded', function() {
    var section = document.getElementById('mg-section');
    var chevron = document.getElementById('mg-chevron');
    if (!section || !chevron) return;

    var isActive = {{ $mgActive ? 'true' : 'false' }};

    if (isActive) {
      // Start opened
      section.classList.remove('hidden');
      section.style.maxHeight = '';
      section.style.opacity = '1';
      chevron.classList.remove('rotate-180');
    } else {
      // Start closed
      section.classList.add('hidden');
      section.style.maxHeight = '';
      section.style.opacity = '';
      chevron.classList.add('rotate-180');
    }

    // Initialize Website dropdown
    var sectionWeb = document.getElementById('web-section');
    var chevronWeb = document.getElementById('web-chevron');
    if (sectionWeb && chevronWeb) {
      var isActiveWeb = {{ $webActive ? 'true' : 'false' }};
      if (isActiveWeb) {
        sectionWeb.classList.remove('hidden');
        sectionWeb.style.maxHeight = '';
        sectionWeb.style.opacity = '1';
        chevronWeb.classList.remove('rotate-180');
      } else {
        sectionWeb.classList.add('hidden');
        sectionWeb.style.maxHeight = '';
        sectionWeb.style.opacity = '';
        chevronWeb.classList.add('rotate-180');
      }
    }
  });
</script>

<!-- Alpine.js (CDN) for dropdown animation -->
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>