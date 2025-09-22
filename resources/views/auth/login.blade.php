<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Dwi AC Mobil</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
</head>
<body class="h-full">
    <div class="flex h-full">
        <!-- Panel Kiri - Background Image dengan Gradient Overlay -->
        <div class="hidden lg:flex lg:w-1/2 relative">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/ac-background.png') }}');"></div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-l from-[#0F044C]/15 to-[#0F044C]"></div>
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-center px-8 sm:px-12 lg:px-16 xl:px-24 py-16 text-white mx-auto">
                <h1 class="font-montserrat-64 text-white mb-6">SELAMAT DATANG</h1>
                <h2 class="font-montserrat-48 text-white mb-8">DI DWI AC MOBIL</h2>
                <p class="text-lg opacity-90 leading-relaxed">Booking antrian lebih mudah, pelayanan lebih pasti. Jadwalkan servis Anda sekarang.</p>
            </div>
        </div>

        <!-- Panel Kanan - Form Login -->
        <div class="flex-1 flex flex-col justify-center px-8 sm:px-12 lg:px-16 xl:px-24">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="/" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Title -->
            <div class="mb-8 text-center">
                <h1 class="font-montserrat-64 text-gray-900">MASUK</h1>
            </div>

            <!-- Form -->
            <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-[#0F044C] focus:ring-[#0F044C] border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="text-[#0F044C] hover:text-[#0F044C]/80 font-medium">
                            Lupa password?
                        </a>
                    </div>
                    @if($errors->any())
                    <div class="text-red-600 text-sm">
                       {{ $errors->first() }}
                    </div>
                    @endif
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="flex space-x-4 items-end">
                    <div class="flex-1 mt-3">
                        <p class="text-gray-600 text-center">Belum memiliki Akun?</p>
                        <a href="/register" 
                            class="w-full px-6 h-[70px] border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors flex items-center justify-center">
                            Daftar
                        </a>
                    </div>
                    <div class="flex-1">
                        <button type="submit" 
                            class="w-full px-6 h-[70px] bg-[#0F044C] text-white font-medium hover:bg-[#0F044C]/90 transition-colors flex items-center justify-center">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 