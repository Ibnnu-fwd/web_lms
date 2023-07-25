<x-user-layout>
    @push('css-internal')
        <style>
            .background-radial-gradient {
                background-color: hsl(0, 80%, 40%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(0, 80%, 35%) 15%,
                        hsl(0, 80%, 30%) 35%,
                        hsl(0, 80%, 20%) 75%,
                        hsl(0, 80%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(0, 80%, 45%) 15%,
                        hsl(0, 80%, 30%) 35%,
                        hsl(0, 80%, 20%) 75%,
                        hsl(0, 80%, 19%) 80%,
                        transparent 100%);
            }
        </style>
    @endpush
    <section class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-0 max-w-6xl py-12 ">
        <section class="background-radial-gradient mb-12 rounded-md">
            <div class="px-6 py-12 text-center md:px-12 lg:text-left">
                <div class="container mx-auto">
                    <div class="grid items-center gap-12 lg:grid-cols-2">
                        <div class="mt-12 lg:mt-0">
                            <h1
                                class="mb-6 text-5xl font-bold tracking-tight text-[hsl(218,81%,95%)] md:text-6xl xl:text-7xl">
                                About<span class="text-primary ms-2">us</span>
                            </h1>
                            <p class="text-lg text-[hsl(218,81%,95%)]">
                                Kami berkomitmen untuk membantu Anda mencapai potensi penuh Anda dengan menyediakan
                                akses ke kursus online berkualitas dari para ahli di berbagai bidang. Berbekal teknologi
                                terkini dan keahlian para instruktur terbaik, kami hadir untuk mengubah cara Anda
                                belajar dan mengembangkan keterampilan.
                            </p>
                        </div>
                        <div class="mb-12 lg:mb-0">
                            <div class="embed-responsive embed-responsive-16by9 relative w-full overflow-hidden rounded-lg shadow-lg"
                                style="padding-top: 56.25%">
                                <iframe
                                    class="embed-responsive-item absolute top-0 right-0 bottom-0 left-0 h-full w-full"
                                    src="https://www.youtube.com/embed/rs48iVajzWc" allowfullscreen="true"
                                    data-gtm-yt-inspected-2340190_699="true" id="240632615"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- end Hero About -->


        <section>
            <div class="items-center w-full px-5 mx-auto md:px-12 lg:px-0 max-w-6xl py-8 ">
                <div class="justify-center w-full max-auto">
                    <div x-data="{ tab: 'tab1' }">
                        <ul
                            class="flex justify-between mx-auto overflow-hidden text-sm text-center text-black border-y py-6">
                            <li class="w-full">
                                <!-- event handler set state to 'tab1' and add conditional :class for active state -->
                                <a @click.prevent="tab = 'tab1'" href="#"
                                    class="inline-block text-xl font-light w-full px-6 py-2 border-b-2 border-transparent bg-white text-primary border-primary"
                                    :class="{ ' bg-white text-primary  border-primary': tab === 'tab1' }">
                                    Visi & Misi
                                </a>
                            </li>
                            <li class="w-full">
                                <a @click.prevent="tab = 'tab2'" href="#"
                                    class="inline-block text-lg font-light w-full px-6 py-2 border-b-2 border-transparent"
                                    :class="{ ' bg-white text-primary  border-primary': tab === 'tab2' }">
                                    Kenapa Memilih Kami
                                </a>
                            </li>
                            <li class="w-full">
                                <a @click.prevent="tab = 'tab3'" href="#"
                                    class="inline-block text-lg font-light w-full px-6 py-2 border-b-2 border-transparent"
                                    :class="{ ' bg-white text-primary  border-primary': tab === 'tab3' }">
                                    Meet the Team
                                </a>
                            </li>
                        </ul>
                        <div class="py-4 pt-4 text-left bg-white content">
                            <!-- show tab1 only -->
                            <div x-show="tab==='tab1'" class="text-gray-500">
                                <main>
                                    <div class="flex flex-wrap">
                                        <div class="mb-12 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-5/12">
                                            <div class="flex lg:py-12">
                                                <img src="https://mdbcdn.b-cdn.net/img/new/standard/people/033.jpg"
                                                    class="w-full rounded-lg shadow-lg dark:shadow-black/20 z-[10]"
                                                    alt="image" />
                                            </div>
                                        </div>
                                        <div class="w-full shrink-0 grow-0 basis-auto lg:w-7/12">
                                            <div
                                                class="flex h-full items-center rounded-lg p-6 text-center lg:pl-12 lg:text-left">
                                                <div class="lg:pl-12">

                                                    <h2 class="mb-6 text-2xl font-semibold text-gray-600">Visi</h2>
                                                    <p class="mb-6 text-lg text-gray-500 font-light text-justify">
                                                        Menjadi lembaga pendidikan terdepan dalam memberikan kesempatan
                                                        bagi setiap individu untuk belajar dengan mudah dan terjangkau,
                                                        tanpa batasan geografis.
                                                    </p>
                                                    <h2 class="mb-6 text-2xl font-semibold text-gray-600">
                                                        Misi
                                                    </h2>
                                                    <ul
                                                        class="list-outside mb-6 pb-2 lg:pb-0 text-lg text-gray-500 font-light text-justify">
                                                        <li class="mb-2">
                                                            <div class="flex items-start space-x-3">
                                                                <ion-icon class="text-red-500 md hydrated mr-2"
                                                                    name="checkmark-circle" role="img"
                                                                    size="large">
                                                                </ion-icon>
                                                                <p>Memungkinkan setiap individu untuk belajar
                                                                    dengan
                                                                    mudah dan terjangkau, tanpa batasan geografis.</p>
                                                            </div>
                                                        </li>

                                                        <li class="mb-2">
                                                            <div class="flex items-start space-x-3">
                                                                <ion-icon class="text-red-500 md hydrated mr-2"
                                                                    name="checkmark-circle" role="img"
                                                                    size="large">
                                                                </ion-icon>
                                                                <p>Menyajikan pengalaman belajar yang luar biasa
                                                                    dengan
                                                                    fokus pada kualitas konten dan materi pembelajaran.
                                                                </p>
                                                            </div>
                                                        </li>
                                                        <li class="mb-2">
                                                            <div class="flex items-start space-x-3">
                                                                <ion-icon class="text-red-500 md hydrated mr-2"
                                                                    name="checkmark-circle" role="img"
                                                                    size="large">
                                                                </ion-icon>
                                                                <p>Percaya bahwa
                                                                    pendidikan
                                                                    adalah kunci untuk menciptakan perubahan positif
                                                                    dalam hidup
                                                                    dan
                                                                    masyarakat.</p>
                                                            </div>
                                                        </li>
                                                        <li class="mb-2">
                                                            <div class="flex items-start space-x-3">
                                                                <ion-icon class="text-red-500 md hydrated mr-2"
                                                                    name="checkmark-circle" role="img"
                                                                    size="large">
                                                                </ion-icon>
                                                                <p>Mengutamakan antarmuka pengguna yang intuitif dan
                                                                    navigasi yang sederhana untuk memberikan pengalaman
                                                                    belajar
                                                                    yang
                                                                    lancar.</p>
                                                            </div>
                                                        </li>
                                                    </ul>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                            <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                                <main>
                                    <div class="mx-auto lg:py-12">
                                        <div class="grid grid-cols-2 justify-center basis-auto gap-6">
                                            <div class="mb-12  flex">
                                                <div class="shrink-0">
                                                    <div class="rounded-md p-4 shadow-lg bg-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="h-6 w-6 text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4 grow">
                                                    <p class="mb-2 font-bold text-xl text-black">Support 24/7</p>
                                                    <p class="text-lg font-light leading-6">
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Nihil quisquam quibusdam modi sapiente magni molestias
                                                        pariatur facilis reprehenderit facere aliquam ex.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-12 flex">
                                                <div class="shrink-0">
                                                    <div class="rounded-md p-4 shadow-lg bg-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="h-6 w-6 text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4 grow">
                                                    <p class="mb-2 font-bold text-xl text-black">Safe and solid</p>
                                                    <p class="text-lg font-light leading-6">
                                                        Eum nostrum fugit numquam, voluptates veniam neque quibusdam
                                                        ullam aspernatur odio soluta, quisquam dolore animi mollitia a
                                                        omnis praesentium, expedita nobis!
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-12 flex">
                                                <div class="shrink-0">
                                                    <div class="rounded-md p-4 shadow-lg bg-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="h-6 w-6 text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4 grow">
                                                    <p class="mb-2 font-bold text-xl text-black">Extremely fast</p>
                                                    <p class="text-lg font-light leading-6">
                                                        Enim cupiditate, minus nulla dolor cumque iure eveniet facere
                                                        ullam beatae hic voluptatibus dolores exercitationem? Facilis
                                                        debitis aspernatur amet nisi iure eveniet facere?
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex">
                                                <div class="shrink-0">
                                                    <div class="rounded-md p-4 shadow-lg bg-primary ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" class="h-6 w-6 text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4 grow">
                                                    <p class="mb-2 font-bold text-xl text-black">Live analytics</p>
                                                    <p class="text-lg font-light leading-6">
                                                        Illum doloremque ea, blanditiis sed dolor laborum praesentium
                                                        maxime sint, consectetur atque ipsum ab adipisci ullam
                                                        aspernatur odio soluta, quisquam dolore
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                            <div x-show="tab==='tab3'" class="text-gray-500" style="display: none;">
                                <main>
                                    <!-- === Remove and replace with your own content... === -->
                                    <section class="mb-32 text-center">
                                        <div class="lg:gap-xl-12 grid gap-x-6 md:grid-cols-2 lg:grid-cols-4">

                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="mt-4 lg:py-12 mb-6 lg:mb-0">
                                                    <img class="mx-auto mb-6 rounded-lg shadow-lg dark:shadow-black/20 w-[150px]"
                                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(9).jpg"
                                                        alt="avatar" />
                                                    <h5 class="mb-4 text-lg text-black font-bold">Alan Turing</h5>
                                                    <p class="mb-6 font-light text-lg text-gray-500">Frontend Developer
                                                    </p>
                                                </div>
                                            @endfor
                                        </div>
                                    </section>
                                    <!-- === End ===  -->
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</x-user-layout>
