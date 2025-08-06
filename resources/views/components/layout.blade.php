<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</head>
<body class>
<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<header class="bg-gradient-to-b from-[#0F044C] to-[#FFFFFF00]">
  <nav class="flex items-center justify-between px-8 lg:px-6 xl:px-10 py-5">
    <!-- Logo -->
    <div class="flex items-center">
      <a href="/" class="flex items-center space-x-2">
          <!-- Logo PNG -->
          <img src="/images/logo.png" alt="Dwi AC Mobil Logo" class="h-10 w-auto sm:h-12 lg:h-14">
        </span>
      </a>
    </div>
    <!-- Menu -->
    <div class="hidden lg:flex items-center space-x-20">
      <x-nav-link href="/" :active="request()->is('/')">
        Beranda
       </x-nav-link>
      <x-nav-link href="/layanan" :active="request()->is('/layanan')">
        Layanan
      </x-nav-link>
      <x-nav-link href="/">
        Galeri
      </x-nav-link>
      <x-nav-link href="/">
        Kontak
      </x-nav-link>
      <x-nav-link href="/">
        Review
      </x-nav-link>
    </div>
    <!-- Daftar Akun & User Icon -->
    <div class="flex items-center space-x-4">
      <a href="#" class="hidden lg:inline-block bg-white/20 text-white text-lg font-medium px-6 py-2 rounded-xl shadow hover:bg-white/30 transition">Daftar Akun</a>
      <span class="inline-flex items-center justify-center h-10 w-10 rounded-full border-2 border-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" class="h-7 w-7">
          <circle cx="12" cy="8" r="4" stroke-width="2"/>
          <path stroke-width="2" d="M4 20c0-4 16-4 16 0"/>
        </svg>
      </span>
    </div>
  </nav>
  <el-dialog>
    <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
      <div tabindex="0" class="fixed inset-0 focus:outline-none">
        <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" class="h-8 w-auto" />
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
                <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Beranda</a>
                <a href="/layanan" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Layanan</a>
                <a href="/galeri" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Galeri</a>
                <a href="/kontak" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Kontak</a>
                <a href="/review" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Review</a>
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
<div class="relative isolate overflow-hidden bg-white-900 py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <h2 class="text-5xl font-semibold tracking-tight text-black sm:text-7xl">DwiACMobil</h2>
      <h3 class="text-5xl font-semibold tracking-tight text-black sm:text-7xl">{{ $heading }}</h3>
      <p class="mt-8 text-lg font-medium text-pretty text-gray-300 sm:text-xl/8">{{ $slot }}</p>
    </div>
  </div>
</div>
</body>
</html>