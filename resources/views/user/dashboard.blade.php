<x-app-layout>
    <x-breadcrumb name="user-dashboard" />
    <x-card-container>
        <div class="justify-start w-full text-left">
            <div x-data="{ tab: 'tab1' }">
                <ul class="flex gap-3 text-gray-500 mb-6">
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab1'" href="#"
                            class="inline-block px-4 py-1 text-sm font-medium rounded-md text-white bg-primary"
                            :class="{ '  text-white bg-primary': tab === 'tab1' }">Kelas yang di
                            pelajari</a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab2'" href="#"
                            class="inline-block px-4 py-1 text-sm font-medium rounded-md"
                            :class="{ '  text-white bg-primary': tab === 'tab2' }"> Kelas yang diselesaikan
                        </a>
                    </li>

                </ul>
                <div class="py-4 pt-4 text-left bg-white content">
                    <div x-show="tab==='tab1'"
                        class="text-gray-500 md:grid xl:grid-cols-2 2xl:grid-cols-3 gap-8 space-y-5 md:space-y-0">
                        @for ($i = 1; $i <= 5; $i++)
                            <x-card-container>
                                {{-- <ion-icon name="code-slash" size="large"></ion-icon> --}}
                                <h1 class="text-lg font-medium text-gray-900">
                                    Belajar Pemrograman PHP
                                </h1>
                                <div class="flex flex-row items-center gap-5 mt-2">
                                    <div class="flex flex-row items-center gap-2 ">
                                        <ion-icon name="time-outline" style="font-size:20px"></ion-icon>
                                        <span class="text-sm font-light text-gray-400"> 29 jul - 29 Aug
                                        </span>
                                    </div>
                                    <div class="flex flex-row items-center gap-2 ">
                                        <ion-icon name="book-outline" style="font-size:20px"></ion-icon>
                                        <span class="text-sm font-light text-gray-400"> 10 Materi </span>
                                    </div>
                                </div>
                                <x-link-button title="Belajar" class="mt-6" color="dark" />
                            </x-card-container>
                        @endfor
                    </div>
                    <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <span class="inline-flex items-center text-black">
                                    <span class="font-mono text-sm" aria-hidden="true">02</span><span
                                        class="ml-3 h-3.5 w-px bg-black"></span><span
                                        class="ml-3 text-base font-medium tracking-tight">Tab content</span>
                                </span>
                                <div class="h-32 border border-gray-200 border-dashed rounded-lg"></div>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab3'" class="text-gray-500" style="display: none;">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <span class="inline-flex items-center text-black">
                                    <span class="font-mono text-sm" aria-hidden="true">03</span><span
                                        class="ml-3 h-3.5 w-px bg-black"></span><span
                                        class="ml-3 text-base font-medium tracking-tight">Tab content</span>
                                </span>
                                <div class="h-32 border border-gray-200 border-dashed rounded-lg"></div>
                            </div>
                            <!-- === End ===  -->

                            <x-card-container class="mb-2">
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Belajar Pemrograman Php
                                    </h1>
                                    <button
                                        class="inline-flex items-center justify-center px-3 py-3 text-md font-bold leading-none text-white bg-primary rounded-full">Belajar
                                        Lagi</button>
                                </div>
                            </x-card-container>
                            <x-card-container class="mb-2">
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Belajar Pemrograman Php
                                    </h1>
                                    <button
                                        class="inline-flex items-center justify-center px-3 py-3 text-md font-bold leading-none text-white bg-primary rounded-full">Belajar
                                        Lagi</button>
                                </div>
                            </x-card-container>
                            <x-card-container class="mb-2">
                                <div class="flex flex-row items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Belajar Pemrograman Php
                                    </h1>
                                    <button
                                        class="inline-flex items-center justify-center px-3 py-3 text-md font-bold leading-none text-white bg-primary rounded-full">Belajar
                                        Lagi</button>
                                </div>
                            </x-card-container>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </x-card-container>
</x-app-layout>
