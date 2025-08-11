<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Dwi AC Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/custom-fonts.css">
</head>
<body class="h-full">
    <div class="flex h-full">
        <!-- Panel Kiri - Background Image dengan Gradient Overlay -->
        <div class="hidden lg:flex lg:w-1/2 relative">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/ac-backgrounddaf.png');"></div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-l from-[#0F044C]/15 to-[#0F044C]"></div>
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-center px-8 sm:px-12 lg:px-16 xl:px-24 py-16 text-white mx-auto">
                <h1 class="font-montserrat-64 text-white mb-6">SELAMAT DATANG</h1>
                <h2 class="font-montserrat-alt-48 text-white mb-8">DI DWI AC MOBIL</h2>
                <p class="text-lg opacity-90 leading-relaxed">Booking antrian lebih mudah, pelayanan lebih pasti. Jadwalkan servis Anda sekarang.</p>
            </div>
        </div>

        <!-- Panel Kanan - Form Register -->
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
                <h1 class="font-montserrat-64 text-gray-900">DAFTAR</h1>
            </div>

            <!-- Form -->
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Anda
                    </label>
                    <input id="name" name="name" type="text" required 
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                        No. WA
                    </label>
                    <input id="whatsapp" name="whatsapp" type="tel" required 
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input id="email" name="email" type="email" required 
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#0F044C] focus:border-[#0F044C] outline-none transition-colors">
                </div>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="flex space-x-4 items-end">
                    <div class="flex-1">
                        <p class="text-gray-600 mb-2 text-left">Sudah memiliki Akun?</p>
                        <a href="/login" 
                            class="w-full px-6 h-[70px] border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors flex items-center justify-center">
                            Login
                        </a>
                    </div>
                    <div class="flex-1">
                        <button type="submit" 
                            class="w-full px-6 h-[70px] bg-[#0F044C] text-white font-medium hover:bg-[#0F044C]/90 transition-colors flex items-center justify-center">
                            Daftar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 