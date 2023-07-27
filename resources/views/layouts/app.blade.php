<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            <div class="flex h-screen overflow-hidden bg-white">
                @include('admin.layout.sidebar')
                {{-- burger button --}}
                {{-- end burger button --}}
                <div class="flex flex-col flex-1 w-0 overflow-hidden">
                    <main class="relative flex-1 overflow-y-auto focus:outline-none">
                        <div class="py-6">
                            <div class="px-4 mx-auto 2xl:max-w-9xl sm:px-6 md:px-8">
                                {{$slot}}
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
    </script>

    @stack('js-internal')
</body>

</html>
