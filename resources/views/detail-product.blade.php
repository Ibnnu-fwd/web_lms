<x-user-layout>
    <section class="items-center bg-gray-50 w-full px-5 mx-auto md:px-12 lg:px-6 py-16">
        <section class="max-w-6xl mx-auto">
            <div class="grid grid-cols-12 gap-x-8">
                <div class="hidden lg:block lg:col-span-3">
                    <img src="{{ asset('storage/courses/' . $course->main_image) }}"
                        class="object-cover bg-gray-50 aspect-auto h-40 w-40 lg:h-60 lg:w-60 rounded-md" alt="">
                </div>
                <div class="col-span-12 lg:col-span-6">
                    <div class="flex mb-2 items-center">
                        <img src="{{ asset('icon/category.svg') }}" class="h-3 w-3 lg:h-5 lg:w-5" alt="">
                        <span class="font-medium ml-2">
                            <div class="flex flex-wrap">
                                <p class="flex">{{ $course->category->name }}</p>
                            </div>
                        </span>
                    </div>
                    <h3 class="mb-3 font-medium text-2xl">{{ $course->title }}</h3>
                    <div class="mb-3 flex flex-wrap items-center">
                        <p class="font-medium mr-2 my-auto">Teknologi:</p>
                        @foreach ($techSpecs as $tech)
                            <span
                                class="inline-block px-2 py-1 my-2 text-xs 2xl:text-sm text-turquoise-800 border border-gray-200 rounded-lg mr-2">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="flex mb-4 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                            class="mr-2 h-3 w-3 md:h-5 md:w-5 text-gray-700">
                            <path fill-rule="evenodd"
                                d="M5 2.667a2.333 2.333 0 100 4.666 2.333 2.333 0 000-4.666zM4 5a1 1 0 112 0 1 1 0 01-2 0zM11 2.667a2.333 2.333 0 100 4.666 2.333 2.333 0 000-4.666zM10 5a1 1 0 112 0 1 1 0 01-2 0zM8 9.558a3.667 3.667 0 00-6.667 2.109V14c0 .368.299.667.667.667h12a.667.667 0 00.667-.667v-2.333A3.667 3.667 0 008 9.558zm-.667 3.775v-1.668a2.333 2.333 0 00-4.666.002v1.666h4.666zm1.334-1.668v1.668h4.666v-1.666a2.333 2.333 0 00-4.666-.002z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">
                            {{ $course->users ? $course->users->count() : '0' }}
                        </span>
                        <p class="m-0 ml-2 text-gray-700">Pengguna Terdaftar</p>
                    </div>
                    <span class="font-light text-gray-600">{{ $course->short_description }}</span>
                </div>
                <div class="col-span-3">
                    <div class="card border-none shadow-lg bg-white rounded-lg mt-5 hidden md:block p-4 z-10">
                        <div class="card-body">
                            @guest
                                <div class="mb-2">
                                    <span
                                        class="text-2xl font-medium text-gray-700">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                    <span class="text-xs 2xl:text-sm text-gray-500">/Bulan</span>
                                </div>
                            @endguest
                            @auth
                                <div class="mb-2">
                                    @if (isset($discount) && $discount == true)
                                        <div>
                                            {{-- coret harga asli --}}
                                            <span
                                                class="text-xs 2xl:text-sm text-gray-500 line-through">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                            {{-- harga setelah diskon --}}
                                            <br>
                                            <span
                                                class="text-2xl font-medium text-gray-700">Rp{{ number_format($discount->discount_price, 0, ',', '.') }}</span>
                                            <span class="text-xs 2xl:text-sm text-gray-500">/Bulan</span>
                                        </div>

                                        <small class="text-xs animate-pulse text-gray-500">
                                            Diskon berlaku sampai
                                            {{ date('d F Y', strtotime($discount->end_date)) }}
                                        </small>
                                    @else
                                        <span
                                            class="text-2xl font-medium text-gray-700">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                        <span class="text-xs 2xl:text-sm text-gray-500">/Bulan</span>
                                    @endif
                                </div>
                            @endauth
                            @auth
                                @if (isset($isBought) && $isBought == true)
                                    <x-link-button type="button" title="Belajar Sekarang"
                                        route="{{ route('user.course.detail', [$course->id, 1]) }}" class="w-full" />
                                @else
                                    @if ($course->isInCart)
                                        <x-link-button type="button" title="Lihat Keranjang" route="{{ route('cart') }}"
                                            class="w-full" />
                                    @else
                                        <x-button type="button" color="dark" title="Beli Kelas" class="w-full"
                                            onclick="addToCart({{ $course->id }})" />
                                    @endif
                                @endauth
                            @else
                                <x-button type="button" color="dark" title="Beli Kelas" class="w-full"
                                    onclick="window.location.href='{{ route('login') }}'" />
                            @endauth
                            <hr class="my-4">
                            <p class="text-gray-400 text-xs">
                                Belajar sekarang dan dapatkan ilmu baru yang bermanfaat untuk karir dan masa
                                depanmu.
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
        @foreach ($benefits as $benefit)
            <div class="border border-1 rounded-md h-30 flex flex-col lg:flex-row items-start p-4">
                <div class="mr-3 mb-2 lg:mb-0">
                    <ion-icon class="w-8 h-8 text-red-500 md hydrated mr-1 hidden md:inline-block" name="ribbon"
                        role="img">
                    </ion-icon>
                </div>
                <div>
                    <p class="font-medium mb-1">{{ $benefit->title }}</p>
                    <p class="text-gray-400 text-md">{{ $benefit->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Detail Course -->
<section class="w-full px-5 md:px-0 mx-auto py-10 mb-10 md:max-w-6xl">
    <div class="grid md:grid-cols-2 gap-x-8 gap-y-8">
        <main>
            <h2 class="text-xl font-medium text-gray-700">Deskripsi</h2>
            <p class="leading-6 text-gray-500 mt-4">
                {{ $course->description }}
            </p>
        </main>
        <main>
            <h2 class="text-xl font-medium text-gray-700">Kontributor</h2>
            <p class="text-gray-400 mt-4">Mereka yang membantu dalam pembuatan kelas ini:</p>
            <div class="grid md:grid-cols-2 gap-4 mt-4">
                {{-- @foreach ($suthors as $author) --}}
                <div class="flex items-center">
                    <img src="{{ asset('images/no_image.jpg') }}" class="rounded-full w-12 h-12 mr-4"
                        alt="kontributor">
                    <div>
                        <p class="font-medium">
                            {{ $course->user->fullname }}
                        </p>
                        <p class="text-gray-400">{{ $course->user->job ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </main>
        <main>
            <h2 class="text-xl font-medium text-gray-700">Tujuan Pembelajaran</h2>
            <ul role="list" class="grid grid-cols-1 mt-5 gap-4 list-none lg:grid-cols-2 lg:gap-6">
                @foreach ($courseObjectives as $courseObjective)
                    <li>
                        <div class="flex items-center space-x-2.5">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-success" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span
                                class="text-md font-medium leading-6 text-black">{{ $courseObjective->title }}</span>
                        </div>
                        <div class="ml-6 mt-1 text-sm text-gray-500">
                            {{ $courseObjective->description }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </main>
        <main>
            <h2 class="text-xl font-medium text-gray-700">Sneek Peek</h2>
            <div class="grid grid-cols-4 gap-4 mt-4">
                <img src="{{ asset('storage/sneek_peeks/' . $course->sneek_peek_1) }}"
                    class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                    alt="sneek peek image 1">
                <img src="{{ asset('storage/sneek_peeks/' . $course->sneek_peek_2) }}"
                    class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                    alt="sneek peek image 2">
                <img src="{{ asset('storage/sneek_peeks/' . $course->sneek_peek_3) }}"
                    class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                    alt="sneek peek image 3">
                <img src="{{ asset('storage/sneek_peeks/' . $course->sneek_peek_4) }}"
                    class="bg-gray-50 rounded-md hover:shadow-sm hover:ring-1 hover:ring-primary w-32 h-20 object-cover"
                    alt="sneek peek image 4">
            </div>
        </main>
    </div>
</section>

<!-- Bottom Navigation for Mobile -->
<section class="fixed bottom-0 left-0 right-0 z-10 bg-white shadow-md md:hidden py-3">
    <div class="grid grid-cols-2 gap-x-2 px-5 py-3">
        @auth
            @if (isset($isBought))
                <x-link-button type="button" title="Belajar Sekarang"
                    route="{{ route('user.course.detail', [$course->id, 1]) }}" class="w-full" />
            @else
                <x-button type="button" color="dark" title="Beli Kelas" class="w-full"
                    onclick="addToCart({{ $course->id }})" />
            @endauth
        @else
            <x-button type="button" color="dark" title="Beli Kelas" class="w-full"
                onclick="window.location.href='{{ route('login') }}'" />
        @endauth
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

@push('js-internal')
<script>
    function addToCart(courseId) {
        $.ajax({
            url: "{{ route('product.add-to-cart') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: courseId
            },
            success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }
</script>
@endpush
</x-user-layout>
