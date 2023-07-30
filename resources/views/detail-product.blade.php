<x-user-layout>

    <!-- Course -->
    <section class="items-center bg-gray-50 w-full px-5 mx-auto md:px-12 lg:px-6 py-16">
        <section class="max-w-6xl mx-auto">
            <div class="grid grid-cols-12 gap-x-8">
                <div class="hidden lg:block lg:col-span-3">
                    <img src="{{ asset('images/no_image.jpg') }}"
                        class="object-cover bg-gray-50 aspect-auto h-40 w-40 lg:h-60 lg:w-60 rounded-md" alt="">
                </div>
                <div class="col-span-12 lg:col-span-6">
                    <div class="flex mb-2 items-center">
                        <img src="{{ asset('icon/category.svg') }}" class="h-3 w-3 lg:h-5 lg:w-5" alt="">
                        <span class="font-medium ml-2">
                            <div class="flex flex-wrap">
                                <p class="flex">Mechanic</p>
                            </div>
                        </span>
                    </div>
                    <h3 class="mb-3 font-medium text-2xl">Memulai Pemrograman Dengan Kotlin</h3>
                    <div class="mb-3 flex flex-wrap items-center">
                        <p class="font-medium mr-2 my-auto">Teknologi:</p>
                        <span
                            class="inline-block px-2 py-1 my-2 text-xs 2xl:text-sm text-turquoise-800 border border-gray-200 rounded-lg mr-2">
                            VS Code
                        </span>
                        <span
                            class="inline-block px-2 py-1 my-2 text-xs 2xl:text-sm text-turquoise-800 border border-gray-200 rounded-lg mr-2">
                            Chrome
                        </span>
                        <span
                            class="inline-block px-2 py-1 my-2 text-xs 2xl:text-sm text-turquoise-800 border border-gray-200 rounded-lg mr-2">
                            Tailwind
                        </span>
                    </div>

                    <div class="flex mb-4 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                            class="mr-2 h-3 w-3 md:h-5 md:w-5 text-gray-700">
                            <path fill-rule="evenodd"
                                d="M5 2.667a2.333 2.333 0 100 4.666 2.333 2.333 0 000-4.666zM4 5a1 1 0 112 0 1 1 0 01-2 0zM11 2.667a2.333 2.333 0 100 4.666 2.333 2.333 0 000-4.666zM10 5a1 1 0 112 0 1 1 0 01-2 0zM8 9.558a3.667 3.667 0 00-6.667 2.109V14c0 .368.299.667.667.667h12a.667.667 0 00.667-.667v-2.333A3.667 3.667 0 008 9.558zm-.667 3.775v-1.668a2.333 2.333 0 00-4.666.002v1.666h4.666zm1.334-1.668v1.668h4.666v-1.666a2.333 2.333 0 00-4.666-.002z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">47.527</span>
                        <p class="m-0 ml-2 text-gray-700">Pengguna Terdaftar</p>
                    </div>
                    <span class="font-light text-gray-600">Pelajari dasar bahasa pemrograman, functional programming,
                        object-oriented programming (OOP), serta concurrency dengan menggunakan Kotlin.</span>
                </div>
                <div class="col-span-3">
                    <div class="card border-none shadow-lg bg-white rounded-lg mt-5 hidden md:block p-4 z-10">
                        <div class="card-body">
                            @auth
                                <x-button type="button" title="Belajar Sekarang" class="w-full"
                                    onclick="location.href='{{ route('user.checkout') }}'" />
                            @endauth

                            @guest
                                <x-button type="button" title="Silahkan login" class="bg-dark hover:bg-slate-900 w-full"
                                    onclick="location.href='{{ route('user.checkout') }}'" />
                            @endguest
                            <hr class="my-4">
                            <p class="text-gray-400 text-xs">
                                Belajar sekarang dan dapatkan ilmu baru yang bermanfaat untuk karir dan masa depanmu.
                            </p>
                            {{-- <a href="#"
                                class='flex w-full mb-2 justify-center rounded-md bg-gray-200 px-3 py-1.5 text-sm leading-6 text-black font-medium shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-200'>
                                Informasi kelas
                            </a>
                            <a href="#"
                                class='flex w-full justify-center rounded-md bg-gray-200 px-3 py-1.5 text-sm leading-6 text-black font-medium shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-200'>
                                Lihat silabus
                            </a> --}}
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </section>

    <section class="pb-8 pt-6 border-1 border-y">
        <h2 class="px-3 md:px-0 md:max-w-6xl mx-auto text-xl font-medium text-gray-700">Apa yang akan kamu dapatkan?
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mx-auto px-3 md:px-0 md:max-w-6xl mt-8">
            <div class="border border-1 rounded-md h-30 flex flex-col lg:flex-row items-start p-4">
                <div class="mr-3 mb-2 lg:mb-0">
                    <ion-icon class="w-8 h-8 text-red-500 md hydrated mr-1 hidden md:inline-block" name="ribbon"
                        role="img">
                    </ion-icon>
                </div>
                <div>
                    <p class="font-medium mb-1">Sertifikat</p>
                    <p class="text-gray-400 text-md">Dapatkan sertifikat standar industri setelah menyelesaikan
                        kelas
                        ini.</p>
                </div>
            </div>
            <div class="border border-1 rounded-md h-30 flex flex-col lg:flex-row items-start p-4">
                <div class="mr-3 mb-2 lg:mb-0">
                    <ion-icon class="w-8 h-8 text-red-500 md hydrated mr-1 hidden md:inline-block" name="ribbon"
                        role="img">
                    </ion-icon>
                </div>
                <div>
                    <p class="font-medium mb-1">Sertifikat</p>
                    <p class="text-gray-400 text-md">Dapatkan sertifikat standar industri setelah menyelesaikan
                        kelas
                        ini.</p>
                </div>
            </div>
            <div class="border border-1 rounded-md h-30 flex flex-col lg:flex-row items-start p-4">
                <div class="mr-3 mb-2 lg:mb-0">
                    <ion-icon class="w-8 h-8 text-red-500 md hydrated mr-1 hidden md:inline-block" name="ribbon"
                        role="img">
                    </ion-icon>
                </div>
                <div>
                    <p class="font-medium mb-1">Sertifikat</p>
                    <p class="text-gray-400 text-md">Dapatkan sertifikat standar industri setelah menyelesaikan
                        kelas
                        ini.</p>
                </div>
            </div>
            <div class="border border-1 rounded-md h-30 flex flex-col lg:flex-row items-start p-4">
                <div class="mr-3 mb-2 lg:mb-0">
                    <ion-icon class="w-8 h-8 text-red-500 md hydrated mr-1 hidden md:inline-block" name="ribbon"
                        role="img">
                    </ion-icon>
                </div>
                <div>
                    <p class="font-medium mb-1">Sertifikat</p>
                    <p class="text-gray-400 text-md">Dapatkan sertifikat standar industri setelah menyelesaikan
                        kelas
                        ini.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Course -->
    <section class="w-full px-5 md:px-0 mx-auto py-10 mb-10 md:max-w-6xl">
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-8">
            <main>
                <h2 class="text-xl font-medium text-gray-700">Deskripsi</h2>
                <p class="leading-6 text-gray-500 mt-4">
                    Kotlin merupakan bahasa utama yang digunakan dalam pengembangan Android saat
                    ini. Hal ini karena manfaat yang diberikan seperti ringkas, cepat, dan aman.
                    Selain itu, sifatnya yang interoperability membuat developer bisa beralih dari
                    bahasa Java ke Kotlin dengan cepat. Tak ayal, Google pernah melaporkan hampir
                    80% dari 1000 aplikasi teratas di Play Store menggunakan Kotlin. Selain
                    pengembangan Android, Kotlin dapat digunakan untuk berbagai macam pengembangan,
                    baik itu server, back-end, maupun website.
                </p>
            </main>
            <main>
                <h2 class="text-xl font-medium text-gray-700">Kontributor</h2>
                <p class="text-gray-400 mt-4">Mereka yang membantu dalam pembuatan kelas ini:</p>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <div class="flex items-center">
                        <img src="{{ asset('images/no_image.jpg') }}" class="rounded-full w-12 h-12 mr-4"
                            alt="kontributor">
                        <div>
                            <p class="font-medium">Nama Kontributor</p>
                            <p class="text-gray-400">Role, Pekerjaan saat ini</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/no_image.jpg') }}" class="rounded-full w-12 h-12 mr-4"
                            alt="kontributor">
                        <div>
                            <p class="font-medium">Nama Kontributor</p>
                            <p class="text-gray-400">Role, Pekerjaan saat ini</p>
                        </div>
                    </div>
                </div>
            </main>
            <main>
                <h2 class="text-xl font-medium text-gray-700">Tujuan Pembelajaran</h2>
                <ul role="list" class="grid grid-cols-1 mt-5 gap-4 list-none lg:grid-cols-2 lg:gap-6">
                    <li>
                        <div class="flex items-center space-x-2.5">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-success" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span class="text-md font-medium leading-6 text-black">Individual configuration</span>
                        </div>
                        <div class="ml-6 mt-1 text-sm text-gray-500">
                            Plus, our platform is constantly evolving to meet the changing needs.
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-2.5">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-success" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span class="text-md font-medium leading-6 text-black">Individual configuration</span>
                        </div>
                        <div class="ml-6 mt-1 text-sm text-gray-500">
                            Plus, our platform is constantly evolving to meet the changing needs.
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-2.5">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-success" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span class="text-md font-medium leading-6 text-black">Individual configuration</span>
                        </div>
                        <div class="ml-6 mt-1 text-sm text-gray-500">
                            Plus, our platform is constantly evolving to meet the changing needs.
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-2.5">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-success" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span class="text-md font-medium leading-6 text-black">Individual configuration</span>
                        </div>
                        <div class="ml-6 mt-1 text-sm text-gray-500">
                            Plus, our platform is constantly evolving to meet the changing needs.
                        </div>
                    </li>
                </ul>
            </main>
            <main>
                <h2 class="text-xl font-medium text-gray-700">Sneek Peek</h2>
                <div class="grid grid-cols-4 gap-4 mt-4">
                    <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dmlydHVhbCUyMHJlYWxpdHl8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=600&q=60"
                        class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                        alt="sneek peek image 1">
                    <img src="https://images.unsplash.com/photo-1576633587382-13ddf37b1fc1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8dmlydHVhbCUyMHJlYWxpdHl8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=600&q=60"
                        class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                        alt="sneek peek image 2">
                </div>
            </main>
        </div>
    </section>

    <!-- Bottom Navigation for Mobile -->
    <section class="fixed bottom-0 left-0 right-0 z-10 bg-white shadow-md md:hidden py-3">
        <div class="grid grid-cols-2 gap-x-2 px-5 py-3">
            <x-button type="button" title="Informasi Kelas" class="bg-gray-400 hover:bg-gray-500"
                font="font-light" />
            @auth
                <x-button type="button" title="Belajar Sekarang" />
            @endauth

            <x-button type="button" title="Belajar Sekarang" />
            @guest
                {{-- <x-button type="button" title="Silahkan login" class="bg-dark hover:bg-slate-700"
                    onclick="location.href='{{ route('login') }}'" /> --}}
            @endguest
        </div>
    </section>

    <!-- Modal -->
    <div id="modal"
        class="fixed top-0 left-0 z-50 w-screen h-screen flex items-center justify-center bg-black bg-opacity-50 hidden p-6">
        <div class="max-w-2xl p-4 mx-auto md:w-96 md:h-auto bg-white rounded-md">
            <img id="modal-image" class="w-full h-80 object-cover object-center" src="" alt="Image">
            <p id="modal-caption" class="block mt-2 font-medium text-gray-500"></p>
        </div>
    </div>
</x-user-layout>
