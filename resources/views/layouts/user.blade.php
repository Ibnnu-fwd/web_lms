<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link href="https://fonts.cdnfonts.com/css/rubik" rel="stylesheet">

    <!-- Styles -->
    @stack('css-internal')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-sm antialiased">



    <!-- Navigation -->
    <div class="mx-auto bg-white max-w-6xl">
        <div x-data="{ open: false }"
            class="relative flex flex-col w-full p-5 mx-auto bg-white md:items-center md:justify-between md:flex-row md:px-6 lg:px-0">
            <div class="flex flex-row items-center justify-between lg:justify-start">
                <a class="text-lg tracking-tight text-black uppercase focus:outline-none focus:ring lg:text-2xl"
                    href="/">
                    <img class="h-8" src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'flex': open, 'hidden': !open }"
                class="flex-col items-center flex-grow hidden md:pb-0 md:flex md:justify-end md:flex-row">
                <a class="px-2 py-2 text-xs 2xl:text-sm text-gray-500 lg:px-6 md:px-3 hover:text-red-600 lg:ml-auto
                {{ request()->routeIs('/') ? 'text-red-600' : '' }}"
                    href="{{ route('/') }}">
                    Beranda
                </a>
                <a class="px-2 py-2 text-xs 2xl:text-sm text-gray-500 lg:px-6 md:px-3 hover:text-red-600 {{ request()->routeIs('product') ? 'text-red-600' : '' }}"
                    href="{{ route('product') }}">
                    Materi
                </a>
                <a class="px-2 py-2 text-xs 2xl:text-sm text-gray-500 lg:px-6 md:px-3 hover:text-red-600 {{ request()->routeIs('about') ? 'text-red-600' : '' }}"
                    href="{{ route('about') }}">
                    Tentang Kami
                </a>
                <a class="px-2 py-2 text-xs 2xl:text-sm text-gray-500 lg:px-6 md:px-3 hover:text-red-600 {{ request()->routeIs('order-flow') ? 'text-red-600' : '' }}"
                    href="{{ route('order-flow') }}">
                    Alur Pemesanan
                </a>

                {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm text-left text-gray-500 md:w-auto md:inline md:mt-0 hover:text-red-600 focus:outline-none focus:shadow-outline">
                        <span>
                            Dropdown List
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 rotate-0">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-10 w-screen max-w-xs px-2 mt-3 transform -translate-x-1/2 left-1/2 sm:px-0"
                        style="display: none;">
                        <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="relative grid gap-6 px-5 py-6 bg-white sm:gap-8 sm:p-8">
                                <a href="#"
                                    class="inline-flex items-start p-3 -m-3 transition duration-150 ease-in-out rounded-xl hover:bg-gray-50">
                                    <div class="">
                                        <ion-icon class="w-6 h-6 text-red-500 md hydrated" name="search-outline"
                                            role="img" aria-label="search outline"></ion-icon>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-xs 2xl:text-sm font-medium text-black">
                                            Explore design work
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Trending designs to inspire you
                                        </p>
                                    </div>
                                </a>
                                <a href="#"
                                    class="inline-flex items-start p-3 -m-3 transition duration-150 ease-in-out rounded-xl hover:bg-gray-50">
                                    <div class="">
                                        <ion-icon class="w-6 h-6 text-red-500 md hydrated" name="book-outline"
                                            role="img" aria-label="book outline"></ion-icon>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-xs 2xl:text-sm font-medium text-black">
                                            Blog
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Interviews, tutorials and more
                                        </p>
                                    </div>
                                </a>
                                <a href="#"
                                    class="inline-flex items-start p-3 -m-3 transition duration-150 ease-in-out rounded-xl hover:bg-gray-50">
                                    <div class="">
                                        <ion-icon class="w-6 h-6 text-red-500 md hydrated" name="lock-closed-outline"
                                            role="img" aria-label="lock closed outline"></ion-icon>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-xs 2xl:text-sm font-medium text-black">
                                            Secure
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Interviews, tutorials and more
                                        </p>
                                    </div>
                                </a>
                                <a href="#"
                                    class="inline-flex items-start p-3 -m-3 transition duration-150 ease-in-out rounded-xl hover:bg-gray-50">
                                    <div class="">
                                        <ion-icon class="w-6 h-6 text-red-500 md hydrated" name="people-outline"
                                            role="img" aria-label="people outline"></ion-icon>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-xs 2xl:text-sm font-medium text-black">
                                            Users
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Trending designs to inspire you
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}


                @auth
                    {{-- make dropdown  --}}
                    <div class="inline-flex items-center list-none lg:ml-auto">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex flex-row items-center w-full px-4 py-2 mt-2 text-xs 2xl:text-sm text-left text-black md:w-auto md:inline md:mt-0 hover:text-red-600 focus:outline-none focus:shadow-outline">
                                    <span>
                                        {{ ucwords(Auth::user()->fullname) }}
                                    </span>
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                        :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                        class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 rotate-0">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link
                                    href="{{ // check if auth user is admin route to dashboard, if role = 4 route to user-dashboarsd
                                        Auth::user()->role == 4 ? route('user.dashboard') : (auth()->user()->role == 1 ? route('admin.dashboard') : '#') }}">
                                    <div class="flex items-center gap-x-2">
                                        <ion-icon class="text-gray-300" name="log-in-outline"></ion-icon>
                                        <span>Dashboard</span>
                                    </div>
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('user.cart')">
                                    <div class="flex items-center gap-x-2">
                                        <ion-icon class="text-gray-300" name="cart-outline"></ion-icon>
                                        <span>Keranjang</span>
                                    </div>
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <div class="flex items-center gap-x-2">
                                            <ion-icon class="text-gray-300" name="log-out-outline"></ion-icon>
                                            <span>Keluar</span>
                                        </div>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>

                        </x-dropdown>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
                        <button onclick="window.location.href='{{ route('login') }}'"
                            class="block px-4 py-2 mt-2 text-md text-gray-500 md:mt-0 hover:text-red-600 focus:outline-none focus:shadow-outline">
                            Masuk
                        </button>
                        <button onclick="window.location.href='{{ route('register') }}'"
                            class="inline-flex items-center justify-center px-4 py-2 text-md font-semibold text-white bg-dark rounded-md group focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 hover:bg-slate-700 active:bg-slate-800 active:text-white focus-visible:outline-black">
                            Daftar
                        </button>
                    </div>
                @endauth
            </nav>

        </div>
    </div>

    <!-- Content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-gray-50" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="px-5 py-12 mx-auto max-w-7xl lg:py-16 md:px-12 lg:px-20">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="xl:col-span-1">
                    <a href="/"
                        class="text-lg font-bold tracking-tighter transition duration-500 ease-in-out transform text-black tracking-relaxed lg:pr-8">
                        <img src="{{ asset('images/favicon.png') }}" class="w-8 h-8" alt="logo">
                    </a>
                    <p class="w-1/2 mt-2 text-xs 2xl:text-sm text-gray-500">
                        The smartest way to learn
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-8 mt-12 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="font-medium leading-6 uppercase text-black">
                                Solutions
                            </h3>
                            <ul role="list" class="mt-4 space-y-3">
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Marketing
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Analytics
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Commerce
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Insights
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="font-medium leading-6 uppercase text-black">
                                Support
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Alpine.js
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        Guides
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm text-gray-500 hover:text-red-600">
                                        API Status
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hidden lg:justify-end md:grid md:grid-cols-1">
                        <div class="w-full mt-12 md:mt-0">
                            <div class="mt-8 lg:justify-end xl:mt-0">
                                <h3 class="font-medium leading-6 uppercase text-black">
                                    Hubungi Kami
                                </h3>
                                <p class="mt-4 text-sm font-light text-gray-500 lg:ml-auto">
                                    Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur
                                    68121
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-5 py-12 mx-auto border-t max-w-7xl sm:px-6 md:flex md:items-center md:justify-between lg:px-20">
            {{-- <div class="flex justify-center mb-8 space-x-6 md:order-last md:mb-0">
                <span class="inline-flex justify-center w-full gap-3 lg:ml-auto md:justify-start md:w-auto">
                    <a class="w-6 h-6 transition fill-black hover:text-red-500">
                        <span class="sr-only"> github</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-github" role="img"
                            aria-label="logo github"></ion-icon>

                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-red-500">
                        <span class="sr-only"> twitter</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-twitter" role="img"
                            aria-label="logo twitter"></ion-icon>
                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-red-500">
                        <span class="sr-only">Instagram</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-instagram" role="img"
                            aria-label="logo instagram"></ion-icon>
                    </a>
                    <a class="w-6 h-6 transition fill-black hover:text-red-500">
                        <span class="sr-only">Linkedin</span>
                        <ion-icon class="w-5 h-5 md hydrated" name="logo-linkedin" role="img"
                            aria-label="logo linkedin"></ion-icon>
                    </a>
                </span>
            </div> --}}

            <div class="mt-8 md:mt-0 md:order-1">
                <span class="mt-2 text-sm font-light text-gray-500">
                    Copyright © {{ date('Y') }}
                    <a href="#" class="mx-2 text-wickedred hover:text-gray-500" rel="noopener noreferrer">
                        | Interect merupakan merek dagang dari PT.
                        Indonesia Virtual Education
                    </a>
                </span>
            </div>
        </div>

    </footer>

    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/js/modal-image-minified.js') }}"></script>

    @stack('js-internal')

</body>

</html>
