{{-- Header component: stripped HTML skeleton to avoid duplication with layout --}}
<header class="fixed inset-x-0 top-0 z-50 bg-gradient-to-b from-[#0F044C] to-[#FFFFFF00]">
  <nav class="relative flex items-center justify-between px-8 lg:px-6 xl:px-10 py-5">
    <!-- Logo -->
    <div class="flex items-center">
      <a href="/" class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="Dwi AC Mobil Logo" class="h-10 w-auto sm:h-12 lg:h-14">
      </a>
    </div>
    
    <!-- Menu Desktop -->
    <div id="desktop-nav" data-route="{{ Route::currentRouteName() }}" class="hidden lg:flex items-center space-x-20 lg:absolute lg:left-1/2 lg:-translate-x-1/2 lg:transform">
      <x-nav-link href="{{ route('beranda') }}" :active="request()->routeIs('beranda')">
        Beranda
      </x-nav-link>
      <x-nav-link href="{{ route('layanan') }}" :active="request()->routeIs('layanan')">
        Layanan
      </x-nav-link>
      <x-nav-link href="{{ route('beranda') }}#review" :active="false">
        Review
      </x-nav-link>
      <x-nav-link href="{{ route('beranda') }}#kontak" :active="false">
        Kontak
      </x-nav-link>
      <x-nav-link href="{{ route('beranda') }}#galeri" :active="false">
        Galeri
      </x-nav-link>
    </div>
    
    <!-- Daftar Akun & User Icon -->
    <div class="flex items-center space-x-4">
      @guest
      <a href="/register" class="hidden lg:inline-block bg-white/20 text-white text-lg font-medium px-6 py-2 rounded-xl shadow hover:bg-white/30 transition">Daftar Akun</a>
      <a href="/login" aria-label="Masuk" class="inline-flex items-center justify-center h-10 w-10 rounded-full border-2 border-white hover:bg-white/10 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" class="h-7 w-7">
          <circle cx="12" cy="8" r="4" stroke-width="2"/>
          <path stroke-width="2" d="M4 20c0-4 16-4 16 0"/>
        </svg>
      </a>
      @endguest

      @auth
      @php
        $user = Auth::user();
        // Prefer 'nama' as per Pelanggan schema, then fallback
        $displayName = $user->nama ?? ($user->name ?? ($user->username ?? ($user->email ?? '')));
        $initial = $displayName !== '' ? mb_strtoupper(mb_substr($displayName, 0, 1, 'UTF-8'), 'UTF-8') : 'U';

        // Build avatar URL like in ProfileController: profile_photo is a public path, e.g., images/user/profiles/...
        $avatarUrl = null;
        if (!empty($user->profile_photo)) {
          $path = $user->profile_photo;
          if (\Illuminate\Support\Str::startsWith($path, ['http://','https://'])) {
            $avatarUrl = $path;
          } else {
            // Validate file exists in public path, then use asset()
            if (\Illuminate\Support\Facades\File::exists(public_path($path))) {
              $avatarUrl = asset($path);
            }
          }
        }
      @endphp
      <div class="relative group">
        <button type="button" aria-haspopup="true" aria-expanded="false" class="inline-flex items-center justify-center h-11 w-11 rounded-full border-2 border-white bg-white/10 hover:bg-white/20 transition overflow-hidden">
          @if ($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="Avatar" class="h-full w-full object-cover" />
          @else
            <span class="text-white font-semibold">{{ $initial }}</span>
          @endif
        </button>
        <div class="absolute right-0 mt-3 w-52 rounded-lg bg-white shadow-lg ring-1 ring-black/5 invisible opacity-0 translate-y-1 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 group-focus-within:visible group-focus-within:opacity-100 group-focus-within:translate-y-0 transition">
          <!-- Hover bridge to prevent accidental close when moving cursor from button to menu -->
          <div class="absolute -top-3 right-0 h-3 w-full"></div>
          <div class="py-2">
            <a href="/profile" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
            <form method="POST" action="{{ url('/logout') }}">
              @csrf
              <button type="submit" class="w-full text-left block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
            </form>
          </div>
        </div>
      </div>
      @endauth
    </div>
  </nav>
  <script>
    (function() {
      var container = document.getElementById('desktop-nav');
      if (!container) return;

      var route = container.getAttribute('data-route') || '';
      var links = Array.prototype.slice.call(container.querySelectorAll('a.nav-link'));

      function getKeyFromLink(link) {
        var href = link.getAttribute('href') || '';
        if (href.indexOf('#galeri') !== -1) return 'galeri';
        if (href.indexOf('#kontak') !== -1) return 'kontak';
        if (href.indexOf('#review') !== -1) return 'review';
        if (href.indexOf('/layanan') !== -1) return 'layanan';
        return 'beranda';
      }

      function setActive(key) {
        links.forEach(function(link) {
          var indicator = link.querySelector('.active-indicator');
          var isActive = getKeyFromLink(link) === key;
          if (indicator) {
            indicator.classList.toggle('opacity-100', isActive);
            indicator.classList.toggle('opacity-0', !isActive);
          }
        });
      }

      function initFromLocation() {
        var hash = (window.location.hash || '').replace('#','');
        var key = (route === 'layanan') ? 'layanan' : 'beranda';
        if (route === 'beranda' && (hash === 'galeri' || hash === 'kontak' || hash === 'review')) {
          key = hash;
        }
        setActive(key);
      }

      // On-click for instant feedback when using same-page hash links
      container.addEventListener('click', function(e) {
        var a = e.target.closest('a.nav-link');
        if (!a) return;
        var href = a.getAttribute('href') || '';
        if (href.indexOf('#') !== -1) {
          var key = getKeyFromLink(a);
          setActive(key);
        }
      }, true);

      // Observe sections visibility on Beranda only
      if (route === 'beranda') {
        var ids = ['galeri','kontak','review'];
        var observed = [];
        var firstSection = null;
        ids.forEach(function(id) {
          var el = document.getElementById(id);
          if (el) {
            observed.push(el);
            if (!firstSection) firstSection = el;
          }
        });

        if (observed.length) {
          try {
            var activeByObserver = '';
            var io = new IntersectionObserver(function(entries) {
              entries.forEach(function(entry) {
                if (entry.isIntersecting && entry.intersectionRatio >= 0.55) {
                  activeByObserver = entry.target.id;
                  setActive(activeByObserver);
                }
              });
            }, { threshold: [0.55] });

            observed.forEach(function(el) { io.observe(el); });

            // Fallback: when above first section, highlight Beranda
            window.addEventListener('scroll', function() {
              if (!firstSection) return;
              var top = firstSection.getBoundingClientRect().top;
              if (top > 120 && activeByObserver !== '') {
                activeByObserver = '';
                setActive('beranda');
              }
            }, { passive: true });
          } catch (e) {
            // If IntersectionObserver not supported, rely on hash only
          }
        }
      }

      window.addEventListener('hashchange', initFromLocation);
      initFromLocation();
    })();
  </script>
  <!-- Mobile Menu -->
  <el-dialog>
    <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
      <div tabindex="0" class="fixed inset-0 focus:outline-none">
        <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="/" class="-m-1.5 p-1.5">
              <span class="sr-only">Dwi AC Mobil</span>
              <img src="{{ asset('images/logo.png') }}" alt="Dwi AC Mobil Logo" class="h-8 w-auto" />
            </a>
            <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Close menu</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a href="{{ route('beranda') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->routeIs('beranda') ? 'text-blue-600' : 'text-gray-900' }}">Beranda</a>
                <a href="{{ route('layanan') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 {{ request()->routeIs('layanan') ? 'text-blue-600' : 'text-gray-900' }}">Layanan</a>
                <a href="{{ route('beranda') }}#review" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 text-gray-900">Review</a>
                <a href="{{ route('beranda') }}#kontak" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 text-gray-900">Kontak</a>
                <a href="{{ route('beranda') }}#galeri" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold hover:bg-gray-50 text-gray-900">Galeri</a>
              </div>
              <div class="py-6">
                <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
              </div>
            </div>
          </div>
        </el-dialog-panel>
      </div>
    </dialog>
  </el-dialog>

</header>
