<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link href="https://fonts.cdnfonts.com/css/rubik" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://nightly.datatables.net/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://nightly.datatables.net/responsive/css/responsive.dataTables.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Alert -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />

    <!-- Jquery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="mx-auto">
        <!-- Navbar -->
        <nav class="flex justify-between items-center px-4 py-2 bg-white border-b">
            <!-- Icon Panah untuk Kembali -->
            <a href="#" onclick="window.history.back();" class="text-gray-600 hover:text-gray-800">
                <ion-icon name="arrow-back-outline" class="text-2xl"></ion-icon>
            </a>
            <!-- Judul -->
            <h1 class="text-base font-normal">
                {{ $course->title }}
            </h1>
            <!-- Placeholder untuk bagian kanan, misalnya tombol logout, notifikasi, dll. -->
            <div>
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
            </div>
        </nav>

        <div class="md:flex md:flex-shrink-0 absolute ml-52">
            <div class="flex items-center">
                <button id="toggleButton" @click="toggleSidebar()"
                    class="toggle-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-300 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>


        <div class="flex min-h-screen">
            <!-- Sidebar (Materials List) -->
            <div class="flex flex-col w-64 " id="sidebar-container">
                <div class="flex flex-col w-64 duration-300 min-h-screen">
                    <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-white border-r">
                        <div class="flex flex-col flex-grow px-4">
                            <nav class="flex-1 space-y-1 bg-white">
                                <div class="border-b mb-6 pb-8 px-4">

                                    <p class="pt-4 text-xl font-semibold">
                                        List Materi
                                    </p>

                                    <div class="h-1 w-full bg-neutral-200 rounded-full mt-2">
                                        <div class="h-1 bg-primary rounded-full"
                                            style="width: {{ $learnProgress['progress'] }}%">
                                        </div>
                                    </div>
                                    <p class="mt-2">
                                        <span class="text-sm text-gray-500">Progress</span>
                                        <span
                                            class="text-sm text-gray-500 font-medium float-right">{{ $learnProgress['progress'] }}%</span>
                                    </p>
                                </div>
                                {{-- progres --}}
                                <ul>
                                    @foreach ($course->courseChapter as $data)
                                        <li class="mb-4">
                                            <div @if (isset($data->isLearned) && $data->isLearned == true) onclick="window.location.href='{{ route('user.course.detail', [$course->id, $data->id]) }}'" @endif
                                                class="focus:outline-none inline-flex
                                                            items-center w-full px-4 py-2 text-base text-gray-500
                                                            transition duration-200 ease-in-out transform rounded-lg
                                                            focus:shadow-outline hover:bg-gray-100 hover:scale-95
                                                            hover:text-primary
                                                            {{ $loop->iteration == $page ? 'bg-gray-100 text-primary' : '' }}">
                                                <span class="text-xs 2xl:text-sm">{{ $data->title }}</span>
                                                @if ($data->isLearned)
                                                    <ion-icon name="checkmark-done-outline"
                                                        class="ml-auto text-primary"></ion-icon>
                                                @else
                                                    <ion-icon name="play-outline" class="ml-auto"></ion-icon>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col flex-auto w-0 overflow-hidden p-2">
                <main
                    class="relative flex-1 focus:outline-none  lg:max-w-6xl md:w-full md:mt-8 justify-center mx-auto bg-white rounded-lg overflow-y-auto">
                    <div class="py-6">
                        <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
                            <div>
                                @if ($chapter->video_file)
                                    <div class="video-container">
                                        <iframe
                                            src="{{ asset('storage/course/chapter/video/' . $chapter->video_file) }}"
                                            allowfullscreen="true" data-gtm-yt-inspected-2340190_699="true"
                                            id="240632615"></iframe>
                                    </div>
                                @endif

                                {{-- @if ($chapter->scrom_file) --}}
                                <iframe src="{{ asset('unity/index.html') }}" width="1088" height="800"
                                    frameborder="0"></iframe>
                                {{-- @endif --}}

                                @if ($chapter->pdf_file)
                                    <div class="h-fit border border-gray-200 border-dashed rounded-lg">
                                        <iframe src="{{ asset('storage/course/chapter/pdf/' . $chapter->pdf_file) }}"
                                            width="100%" height="100%" frameborder="0" id="pdf-viewer"></iframe>
                                    </div>
                                @endif
                            </div>

                            <!-- === End ===  -->

                            <!-- Previous and Next Button -->
                            <div class="flex justify-between mt-4">
                                @if ($previousChapter)
                                    <a href="{{ route('user.course.detail', [$course->id, $previousChapter->id]) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        <ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>
                                        <span>Sebelumnya</span>
                                    </a>
                                @else
                                    <button disabled
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        <ion-icon name="arrow-back-outline" class="mr-2"></ion-icon>
                                        <span>Sebelumnya</span>
                                    </button>
                                @endif

                                @if ($nextChapter)
                                    <form action="{{ route('user.course.next-page', [$course->id, $chapter->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                            <span>Selanjutnya</span>
                                            <ion-icon name="arrow-forward-outline" class="ml-2"></ion-icon>
                                        </button>
                                    </form>
                                @elseif ($isLastChapter)
                                    <form action="{{ route('user.course.next-page', [$course->id, $chapter->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                            <span>Selesai</span>
                                            <ion-icon name="checkmark-done-outline" class="ml-2"></ion-icon>
                                        </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>

    </div>


    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Datatable -->
    <script src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="https://nightly.datatables.net/responsive/js/dataTables.responsive.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- Ckeditor -->
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"
        integrity="sha512-g16L6hyoieygYYZrtuzScNFXrrbJo/lj9+1AYsw+0CYYYZ6lx5J3x9Yyzsm+D37/7jMIGh0fDqdvyYkNWbuYuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('select').select2();

        var options = {
            // remove toolbar
            toolbar: {
                show: false
            },
        }

        PDFObject.embed("{{ asset('assets/Profile.pdf') }}", "#pdf-viewer", options);
    </script>

    <script>
        $(document).ready(function() {
            const toggleButton = $('#toggleButton');
            const sidebarContainer = $('#sidebar-container');

            let isClicked = false;

            toggleButton.click(function() {
                sidebarContainer.toggleClass('-ml-64');
                sidebarContainer.toggleClass('w-0');
                toggleButton.toggleClass('rotate-180');
                isClicked = !isClicked;

                if (isClicked) {
                    console.log('clicked');
                    toggleButton.animate({
                        marginLeft: '-200px'
                    }, 300);
                } else {
                    console.log('not clicked');
                    toggleButton.animate({
                        marginLeft: '0'
                    }, 300);
                }
            });

            // set video full width
            const videoContainer = $('.video-container');
            const video = $('iframe');

            videoContainer.css('width', '100%');
            videoContainer.css('height', '100%');
            video.css('width', '100%');
            video.css('height', '500px');
            video.css('object-fit', 'cover');
        });
    </script>

    @stack('js-internal')
</body>

</html>
