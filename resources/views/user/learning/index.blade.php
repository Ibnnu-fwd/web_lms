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
    {{-- <link href="https://fonts.cdnfonts.com/css/rubik" rel="stylesheet"> --}}
    <link href="https://fonts.cdnfonts.com/css/lexend-deca" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    <!-- Alert -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar"
        aria-controls="separator-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="separator-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <ul class="space-y-2 font-normal text-xs 2xl:text-sm">
                <li>
                    <p class="p-2 font-medium">
                        Daftar Materi
                    </p>
                </li>
                @foreach ($course->courseChapter as $chapter)
                    <li>
                        <a href="{{ $chapter->is_complete ? route('user.course.detail', [$course->id, $chapter->id]) : '#' }}"
                            class="flex items-center p-2 border text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <ion-icon name="{{ $chapter->is_complete ? 'checkmark-outline' : 'play-circle-outline' }}"
                                class="text-xl text-gray-500 group-hover:text-gray-900"></ion-icon>
                            <span class="ml-3">
                                {{ $chapter->title }}
                            </span>
                        </a>
                    </li>

                    @if ($chapter->quiz)
                        <li>
                            <a href="{{ $chapter->quiz->is_complete ? route('user.course.quiz', $chapter->quiz->id) : '#' }}"
                                class="flex items-center p-2 border text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <ion-icon
                                    name="{{ $chapter->quiz->is_complete ? 'checkmark-outline' : 'play-circle-outline' }}"
                                    class="text-xl text-gray-500 group-hover:text-gray-900"></ion-icon>
                                <span class="ml-3">
                                    {{ $chapter->quiz->title }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach
                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center p-2 border mt-4 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <ion-icon name="log-out-outline" class="text-xl text-gray-500 group-hover:text-gray-900">
                        </ion-icon>
                        <span class="ml-3">
                            Keluar
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 max-w-5xl mx-auto border border-dashed">
            <section>
                <div class="flex justify-end mb-6">
                    <x-link-button title="Selanjutnya" color="dark"
                        route="{{ route('user.course-chapter.complete', $learning->id) }}" />
                </div>
                <div class="items-center">
                    <div class="justify-center w-full">
                        <div x-data="{ tab: 'tab1' }">
                            <ul
                                class="flex justify-between mx-auto overflow-hidden text-sm text-center text-black border divide-x rounded-xl">
                                <li class="w-full">
                                    <!-- event handler set state to 'tab1' and add conditional :class for active state -->
                                    <a @click.prevent="tab = 'tab1'" href="#"
                                        class="inline-block w-full px-6 py-2 font-medium border-b-2 border-transparent bg-white text-blue-500 border-blue-500"
                                        :class="{ ' bg-white text-blue-500  border-blue-500': tab === 'tab1' }">
                                        Teori
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a @click.prevent="tab = 'tab2'" href="#"
                                        class="inline-block w-full px-6 py-2 font-medium border-b-2 border-transparent"
                                        :class="{ ' bg-white text-blue-500  border-blue-500': tab === 'tab2' }">
                                        Video
                                    </a>
                                </li>
                                <li class="w-full">
                                    <a @click.prevent="tab = 'tab3'" href="#"
                                        class="inline-block w-full px-6 py-2 font-medium border-b-2 border-transparent"
                                        :class="{ ' bg-white text-blue-500  border-blue-500': tab === 'tab3' }">
                                        Praktikum
                                    </a>
                                </li>
                            </ul>
                            <div class="py-4 pt-4 text-left bg-white content">
                                <!-- show tab1 only -->
                                <div x-show="tab==='tab1'" class="text-gray-500">
                                    <main>
                                        @if ($learning->pdf_file != null)
                                            <iframe class="h-screen rounded-2xl"
                                                src="{{ asset('storage/course/chapter/pdf/' . $learning->pdf_file) }}"
                                                width="100%"></iframe>
                                        @else
                                            <p> Tidak ada materi </p>
                                        @endif
                                    </main>
                                </div>
                                <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                                    <main>
                                        @if ($learning->video_file != null)
                                            <iframe width="100%" height="500px" class="rounded-2xl"
                                                src="{{ asset('storage/course/chapter/video/' . $learning->video_file) }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        @else
                                            <p> Tidak ada video </p>
                                        @endif
                                    </main>
                                </div>
                                <div x-show="tab==='tab3'" class="text-gray-500" style="display: none;">
                                    <main>
                                        @if ($learning->scrom_file != null)
                                            <iframe
                                                src="{{ asset('storage/course/chapter/scrom/scrom_extracted/' . $data->scrom_file . '/index.html') }}"
                                                width="100%" height="500px"></iframe>
                                        @endif
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>

</html>
