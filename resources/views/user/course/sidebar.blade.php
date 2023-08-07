<div class="flex flex-col w-64 " id="sidebar-container">
    <div class="flex flex-col w-64 duration-300 ">
        <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-white border-r">
            <div class="flex flex-col flex-grow px-4">
                <nav class="flex-1 space-y-1 bg-white">
                    <div class="border-b mb-6 pb-8 px-4">

                        <p class="pt-4 text-xl font-semibold text-primary">
                            List Materi
                        </p>

                        <div class="h-1 w-full bg-neutral-200 dark:bg-neutral-600 mt-6">
                            <div class="h-1 bg-primary" style="width: 45%"></div>
                        </div>
                        <p>
                            <span class="text-sm text-gray-500">Progres</span>
                            <span class="text-sm text-gray-500 float-right">6%</span>
                        </p>
                    </div>
                    {{-- progres --}}
                    <ul>
                        @for ($i = 0; $i < 10; $i++)
                            <li class="mb-4">

                                <div
                                    class="focus:outline-none inline-flex
                                                    items-center w-full px-4 py-2 text-base text-gray-500
                                                    transition duration-200 ease-in-out transform rounded-lg
                                                    focus:shadow-outline hover:bg-gray-100 hover:scale-95
                                                    hover:text-primary text-center justify-center">
                                    <p> Materi {{ $i + 1 }}
                                    </p>
                                </div>
                            </li>
                        @endfor
                    </ul>
                </nav>
            </div>
            <div class="flex flex-shrink-0 p-4 px-4 bg-gray-50">
                <div @click.away="open = false" class="relative inline-flex items-center w-full"
                    x-data="{ open: false }">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-between w-full px-4 py-3 text-lg font-medium text-center text-white transition duration-500 ease-in-out transform rounded-xl hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span>
                            <span class="flex-shrink-0 block group">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block object-cover rounded-full h-9 w-9"
                                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2070&amp;q=80"
                                            alt="">
                                    </div>
                                    <div class="ml-3 text-left">
                                        <p class="text-sm font-medium text-gray-500 group-hover:text-blue-500">
                                            {{ ucwords(Auth::user()->fullname) }}
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
                                    <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                        href="{{ route('dashboard') }}">
                                        <ion-icon class="w-4 h-4 md hydrated" name="body-outline" role="img"
                                            aria-label="body outline"></ion-icon>
                                        <span class="ml-4">
                                            Account
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-500 transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500"
                                        href="#">
                                        <ion-icon class="w-4 h-4 md hydrated" name="person-circle-outline"
                                            role="img" aria-label="person circle outline">
                                        </ion-icon>
                                        <span class="ml-4">
                                            Profile
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
