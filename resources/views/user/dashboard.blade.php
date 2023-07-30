<style>
    /* Style tombol */
    .x-card-container .hover-button {
        display: none;
        /* Gaya lain yang Anda inginkan */
    }

    /* Style x-card-container saat dihover */
    .x-card-container:hover .hover-button {
        display: block;
    }
</style>
<x-app-layout>
    <x-breadcrumb name="user-dashboard" />
    <x-card-container>
        <section>
            <div class="items-center mx-auto max-w-full md:px-5">
                <div class="justify-center w-full md:p-5 max-auto">
                    <div class="justify-start w-full text-left">
                        <div x-data="{ tab: 'tab1' }">
                            <ul class="flex gap-3 text-gray-500">
                                <li class="-mb-px">

                                    <a @click.prevent="tab = 'tab1'" href="#"
                                        class="inline-block px-4 py-1 text-sm font-thin rounded-lg text-white bg-primary"
                                        :class="{ '  text-white bg-primary': tab === 'tab1' }"> Kelas Yang di
                                        pelajari</a>
                                </li>
                                <li class="-mb-px">
                                    <a @click.prevent="tab = 'tab2'" href="#"
                                        class="inline-block px-4 py-1 text-sm font-thin rounded-lg"
                                        :class="{ '  text-white bg-primary': tab === 'tab2' }"> Kelas Yang Diselesaikan
                                    </a>
                                </li>

                            </ul>
                            <div class="py-4 pt-4 text-left bg-white content">
                                <div x-show="tab==='tab1'" class="text-gray-500">
                                    <main>
                                        <x-card-container class="mb-2">
                                            <ion-icon name="code-slash" size="large"></ion-icon>
                                            <div class="flex flex-row items-center justify-between">

                                                <h1 class="text-2xl font-bold text-gray-900">Belajar Pemrograman Php
                                                </h1>
                                                <button
                                                    class="inline-flex items-center justify-center px-3 py-3 text-md font-bold leading-none text-white bg-primary rounded-full">Belajar</button>
                                            </div>
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
                                            {{-- sub materi  --}}
                                            <div class="flex flex-row items-center gap-2 mt-4 border-t-2 ">
                                                <ion-icon name="ellipse-outline"></ion-icon>
                                                <span class="text-lg font-light text-gray-400"> Memulai Dasar
                                                    pemrograman Php </span>
                                            </div>

                                        </x-card-container>

                                        <x-card-container class="mb-2">
                                            <ion-icon name="code-slash" size="large"></ion-icon>
                                            <div class="flex flex-row items-center justify-between">

                                                <h1 class="text-2xl font-bold text-gray-900">Belajar Pemrograman Php
                                                </h1>
                                                <button
                                                    class="inline-flex items-center justify-center px-3 py-3 text-md font-bold leading-none text-white bg-primary rounded-full">Belajar</button>
                                            </div>
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
                                            {{-- sub materi  --}}
                                            <div class="flex flex-row items-center gap-2 mt-4 border-t-2 ">
                                                <ion-icon name="ellipse-outline"></ion-icon>
                                                <span class="text-lg font-light text-gray-400"> Memulai Dasar
                                                    pemrograman Php </span>
                                            </div>

                                        </x-card-container>

                                    </main>
                                </div>
                                <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                                    <main>

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
                </div>
            </div>
        </section>

    </x-card-container>
</x-app-layout>
