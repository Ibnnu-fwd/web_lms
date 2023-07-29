<x-user-layout>
    <section class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
        {{-- <div class="flex flex-col items-center bg-white py-4 sm:flex-row">
            <a href="#" class="text-2xl font-bold text-gray-800">Checkout</a>
        </div> --}}
        <div class="grid lg:grid-cols-2">
            <div class="mt-10 px-4 lg:mt-0">
                <p class="text-xl font-medium">Payment Details</p>
                <p class="text-gray-400">Complete your order by providing your payment details.</p>
                <div class="">
                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                    <div class="relative">
                        <input type="text" id="email" name="email"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="your.email@gmail.com" value="{{ auth()->user()->email }}" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="Your full name here" value="{{ auth()->user()->fullname }}" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                        </div>
                    </div>
                    <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
                    <div class="flex gap-2">
                        <div class="relative w-7/12 flex-shrink-0">
                            <input type="text" id="card-no" name="card-no"
                                class="w-full rounded-md border border-gray-200 px-2 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                                placeholder="xxxx-xxxx-xxxx-xxxx" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                </svg>
                            </div>
                        </div>
                        <input type="text" name="credit-expiry"
                            class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="MM/YY" />
                    </div>
                    <label for="valed-struck" class="mt-4 mb-2 block text-sm font-medium">Valid Struk</label>

                    <div class="relative">
                        <input type="text" id="valed-struck" name="valed-struck"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="Masukkan bukti pembayaran" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <ion-icon name="folder-outline"></ion-icon>
                        </div>
                    </div>

                </div>
                <button class="mt-4 mb-8 w-full rounded-md bg-primary px-6 py-3 font-medium text-white">Place
                    Order</button>
            </div>

            <div class="px-4 pt-8">
                <p class="text-xl font-medium">Pesanan Course mu</p>
                <p class="text-gray-400">Silahkan cek lagi pesanan mu </p>
                <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6 divide-y">
                    <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                            src="https://images.unsplash.com/photo-1588690154757-badf4644190f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8a290bGlufGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                            alt="" />
                        <div class="flex w-full flex-col px-4 py-4">
                            <span class="font-semibold">Memulai Pemrograman Dengan Kotlin</span>
                            <span class="float-right text-gray-400 line-clamp-1">Pelajari dasar bahasa pemrograman,
                                functional
                                programming, object-oriented programming (OOP)</span>
                            <p class="text-lg font-bold">Rp. <span>2000.000</span></p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                            src="https://media.istockphoto.com/id/1478831653/photo/php-interpreted-programming-language-hypertext-preprocessor-programming.webp?b=1&s=170667a&w=0&k=20&c=Uc9Rg3xaN0-d2m2XWgaD0Fqqwf6uZnJxDui9k625e7s="
                            alt="" />
                        <div class="flex w-full flex-col px-4 py-4">
                            <span class="font-semibold">Memulai Pemrograman Dengan Php</span>
                            <span class="float-right text-gray-400 line-clamp-1">Pelajari dasar bahasa pemrograman,
                                functional
                                programming, object-oriented programming (OOP)</span>
                            <p class="mt-auto text-lg font-bold">Rp. <span>2000.000</span></p>
                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">No Rek. Pembayaran</label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="1232 - 12313 - 2131 - 312321" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <ion-icon name="card-outline"></ion-icon>
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="mt-6 border-t border-b py-2">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Subtotal</p>
                            <p class="font-semibold text-gray-900">Rp. <span>4.000.000</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Discount</p>
                            <p class="font-semibold text-gray-900">Rp. <span>0</span></p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Total</p>
                        <p class="text-2xl font-semibold text-gray-900">Rp. <Span>4.000.000</Span></p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</x-user-layout>
