<div class="hidden md:flex md:flex-shrink-0" id="sidebar-container">
    <div class="flex flex-col h-screen w-64">
        <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-white border-r">
            <div class="flex flex-col flex-shrink-0 px-4">
                <a class="text-lg mx-3 font-semibold tracking-tighter text-black focus:outline-none focus:ring "
                    href="" onclick="event.preventDefault();">
                    <img src="{{ asset('images/logo.png') }}" class="w-32 h-full" alt=""> </a>
                <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col flex-grow px-4 mt-5">
                <nav class="flex-1 space-y-1 bg-white">
                    <ul>
                        <!-- Dashboard -->
                        <li>
                            <x-sidebar-link route="{{ route('verificator.dashboard') }}" icon="laptop-outline"
                                title="Dashboard" active="{{ request()->routeIs('verificator.dashboard') }}" />
                        </li>

                        <!-- Course Request -->
                        <li>
                            <x-sidebar-link route="{{ route('verificator.course-request.index') }}"
                                icon="folder-open-outline" title="Permintaan Kursus"
                                active="{{ request()->routeIs('verificator.course-request.*') }}" />
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button
                                    class="inline-flex items-center w-full px-4 py-2 mt-1 text-xs 2xl:text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-primary">
                                    <ion-icon class="w-4 h-4 md hydrated" name="log-out-outline" role="img">
                                    </ion-icon>
                                    <span class="ml-4">
                                        Keluar
                                    </span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex flex-shrink-0 p-4 px-4 bg-gray-50">
                <div @click.away="open = false" class="relative inline-flex items-center w-full"
                    x-data="{ open: false }">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-between w-full px-4 py-3 text-lg font-medium text-center text-white transition duration-500 ease-in-out transform rounded-xl hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <span>
                            <span class="flex-shrink-0 block group">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block object-cover rounded-full h-9 w-9"
                                            src="{{ auth()->user()->avatar ? asset('storage/avatar/' . auth()->user()->avatar) : asset('images/no_image.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="ml-3 text-left">
                                        <p
                                            class="text-xs 2xl:text-sm font-normal line-clamp-1 text-gray-500 group-hover:text-primary">
                                            {{ ucwords(auth()->user()->fullname) }}
                                        </p>
                                        <p
                                            class="text-xs 2xl:text-sm font-light text-gray-500 group-hover:text-primary">
                                            {{ auth()->user()->getRoleLabel() }}
                                        </p>
                                    </div>
                                </div>
                            </span>
                        </span>
                        <svg :class="{ 'rotate-180': open, 'rotate-0': !open }" xmlns="http://www.w3.org/2000/svg"
                            class="inline w-5 h-5 ml-4 text-black transition-transform duration-200 transform rotate-0"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute bottom-0 z-50 w-full mx-auto mt-2 origin-bottom-right bg-white rounded-xl"
                        style="display: none">
                        <div class="px-2 py-2 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul>
                                <li>
                                    <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-xs 2xl:text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-primary"
                                        href="{{ route('admin.account.index') }}">
                                        <ion-icon class="w-4 h-4 md hydrated" name="body-outline" role="img"
                                            aria-label="body outline"></ion-icon>
                                        <span class="ml-4">
                                            Akun
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-xs 2xl:text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-primary"
                                        href="#">
                                        <ion-icon class="w-4 h-4 md hydrated" name="person-circle-outline"
                                            role="img" aria-label="person circle outline"></ion-icon>
                                        <span class="ml-4">
                                            Profil
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
