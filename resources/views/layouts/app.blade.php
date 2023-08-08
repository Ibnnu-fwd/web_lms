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

    <!-- Pdf js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.8.162/web/pdf_viewer.min.css">

    @stack('css-internal')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-transparent">
        <!-- Page Content -->
        <div class="px-2 items-center sm:hidden h-fit">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 focus:outline-none transition duration-150 ease-in-out"
                id="nav-toggle">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <main>
            <div class="flex h-screen overflow-hidden bg-gray-50">
                {{-- jika role nya == 2 maka tampilkan sidebar user --}}
                @php
                    $user = Auth::user();
                    $role = $user->role;
                    $isVerificator = $user->is_verificator;
                @endphp

                @if ($role == 1 && $isVerificator == 0)
                    @include('admin.layout.sidebar')
                @elseif ($role == 3 && $isVerificator == 0)
                    @include('user.layouts.sidebar')
                @elseif ($role == 3 && $isVerificator == 0)
                    @include('user.layouts.sidebar')
                @elseif ($isVerificator == 1)
                    @include('verificator.layout.sidebar')
                @endif

                {{-- end sidebar --}}
                {{-- burger button --}}
                {{-- end burger button --}}
                <div class="flex flex-col flex-1 w-0 overflow-hidden">
                    <main class="relative flex-1 overflow-y-auto focus:outline-none" id="main-content">
                        <div class="py-8">
                            <div class="px-4 mx-auto 2xl:max-w-9xl sm:px-6 md:px-8">
                                {{ $slot }}
                            </div>
                        </div>
                    </main>
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebarContainer = document.getElementById("sidebar-container");
            sidebarContainer.classList.toggle("hidden"); // Toggle the "hidden" class to show/hide the sidebar
        }


        // Attach the toggleSidebar function to the "nav-toggle" button
        const navToggle = document.getElementById("nav-toggle");
        navToggle.addEventListener("click", toggleSidebar);

        // hide main-content when sidebar is open
        const mainContent = document.getElementById("main-content");
        navToggle.addEventListener("click", function() {
            if (mainContent.classList.contains("hidden")) {
                mainContent.classList.remove("hidden");
            } else {
                mainContent.classList.add("hidden");
            }
        });
    </script>



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

    <!-- Pdf js -->
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.8.162/build/pdf.min.js"></script>

    <script>
        $('select').select2();
    </script>

    @stack('js-internal')
</body>

</html>
