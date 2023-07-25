<x-user-layout>

    @push('css-internal')
        <style>
            .category-item:hover .rounded-full {
                background-color: #D21312;
                /* Replace with your desired bg-primary color */
            }

            .category-item:hover .category-item-icon {
                background-color: #D21312;
                color: white;
                /* Replace with your desired text-white color */
            }

            .category-item:hover ion-icon {
                color: #ffffff;
            }

            .category-item:hover .category-item-name {
                color: #D21312;
                /* Replace with your desired text-primary color */
            }

            .card-item:hover img {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
        </style>
    @endpush

    <!-- Stats -->
    <div class="px-4 py-16 mx-auto hidden xl:block sm:max-w-xl md:max-w-full lg:max-w-6xl md:px-0 lg:px-0 lg:py-12">
        <div class="flex justify-between overflow-x-auto md:grid row-gap-8 md:grid-cols-4">
            <div class="text-center md:border-r">
                <p class="items-center flex justify-center">
                    <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="people-circle" role="img">
                    </ion-icon> Lebih dari 10.000 <b class="ml-1"> pengguna</b>
                </p>
            </div>
            <div class="text-center md:border-r">
                <p class="items-center flex justify-center">
                    <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="cube" role="img">
                    </ion-icon> Tersedia berbagai kategori <b class="ml-1"> course</b>
                </p>
            </div>
            <div class="text-center md:border-r">
                <p class="items-center flex justify-center">
                    <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="checkmark-circle" role="img">
                    </ion-icon> Disupport oleh <b class="ml-1"> +500 creator</b>
                </p>
            </div>
            <div class="text-center">
                <p class="items-center flex justify-center">
                    <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="git-merge" role="img">
                    </ion-icon> Fokus pada <b class="ml-1"> pengembangan</b>
                </p>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <section>
        <!-- Jumbotron -->
        <div class="relative overflow-hidden mt-12 md:mt-0 bg-cover bg-no-repeat w-full sm:rounded-md hover:shadow-lg px-5 py-24 mx-auto max-w-6xl md:px-32 lg:px-8"
            style="
        background-position: 50%;
        background-image: url('https://images.unsplash.com/photo-1592478411213-6153e4ebc07d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dnJ8ZW58MHwwfDB8fHwy&auto=format&fit=crop&w=500&q=60');
        height: 300px;
      ">
            <div
                class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.75)] bg-fixed">
                <div class="flex h-full items-center">
                    <div class="px-6 text-white md:px-12">
                        <p class="tracking-tight uppercase text-lg">discover all best course</p>
                        <p class="tracking-tight font-bold text-3xl mt-4">
                            This week: 50% off <br>Greenworks assets
                        </p>
                        <p class="tracking-tight text-lg mt-4">
                            Save 50% on assets from Greenworks and <br>get a free gift in this week’s Publisher Sale.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>

    <!-- Category -->
    <section class="flex items-center w-full bg-white">
        <div class="relative items-center w-full px-5 my-12 mx-auto md:px-0 lg:px-0 lg:max-w-6xl">
            <div class="grid grid-flow-col gap-8 md:gap-0 overflow-auto md:overflow-hidden">
                @for ($i = 1; $i <= 8; $i++)
                    <center class="category-item">
                        <div
                            class="flex justify-center items-center h-16 w-16 rounded-full bg-gray-100 transition-colors category-item-icon">
                            <ion-icon class="w-6 h-6 text-black hydrated" name="git-merge" role="img"></ion-icon>
                        </div>
                        <p
                            class="mt-4 text-md text-center font-bold leading-6 text-black transition-colors category-item-name">
                            Machine
                        </p>
                        <p class="text-md text-center font-medium leading-6 text-gray-600 transition-colors">
                            (200)
                        </p>
                    </center>
                @endfor
            </div>
        </div>
    </section>

    <!-- Product List -->
    <section class="relative items-center w-full px-5 mx-auto md:px-12 pb-24 lg:px-0 max-w-6xl">
        <h2 class="text-2xl font-bold mb-8">Semua course</h2>
        <a class="" href="{{ route('detail-product', 1) }}">
            <div class="grid gap-x-5 gap-y-12 grid-cols-2 md:grid-cols-6">
                @for ($i = 1; $i <= 12; $i++)
                    <figure id="card-item">
                        <img class="w-48 h-36 object-cover rounded-sm"
                            src="https://d33wubrfki0l68.cloudfront.net/2ef8f651607bb32a3fc3a21d71dfe37fe89e2c26/c954d/images/placeholders/square1.svg"
                            alt="">
                        <p class="mt-2 text-xs font-light leading-6 text-gray-400 uppercase">
                            category
                        </p>
                        <p class="text-lg font-normal leading-tight truncate text-black">
                            Course Title
                        </p>
                        <div class="flex items-center mt-2">
                            <p class="items-center flex justify-center text-xs text-gray-500">
                                <ion-icon class="sm hydrated" name="people" role="img">
                                </ion-icon>&nbsp;<span class="text-xs">3.000</span>
                            </p>
                            <div class="h-4 mx-2 border-l border-gray-300"></div>
                            <p class="items-center flex justify-center text-xs text-gray-500">
                                <ion-icon class="sm hydrated" name="heart" role="img">
                                </ion-icon>&nbsp;<span class="text-xs">(121)</span>
                            </p>
                        </div>
                        <p class="text-md mt-2 font-light leading-6 text-primary">
                            IDR 12.000.000
                        </p>

                    </figure>
                @endfor
            </div>
        </a>
    </section>


</x-user-layout>
