<x-user-layout>
    <section class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
        {{-- <div class="flex flex-col items-center bg-white py-4 sm:flex-row">
            <a href="#" class="text-2xl font-bold text-gray-800">Checkout</a>
        </div> --}}
        <div class="grid lg:grid-cols-2">
            <div class="mt-10 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium">Detail Pembayaran</p>
                <p class="text-gray-400">Lengkapi pesanan Anda dengan memberikan detail pembayaran Anda.</p>
                <div class="mt-6">
                    <label for="email" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="email" name="email"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            value="{{ auth()->user()->email }}" disabled />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                        Nama Pemilik Rekening <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder"
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="Your full name here" value="{{ auth()->user()->fullname }}" disabled />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-6 flex items-end justify-between">
                        <p class="text-md text-gray-900">TOTAL</p>
                        <p class="text-xl font-medium text-gray-900">Rp.
                            <span>{{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </p>
                    </div>


                </div>
                <form action="{{ route('checkout.payment') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="mt-8 mb-8 w-full text-lg rounded-md bg-primary px-6 py-3 font-medium text-white">Bayar</button>
                </form>
            </div>

            <div class="px-4 pt-8">
                <p class="text-xl font-medium">Pesanan Course mu</p>
                <p class="text-gray-400">Silahkan cek lagi pesanan mu </p>
                <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-8 sm:px-6">
                    @foreach ($carts as $cart)
                        <div
                            class="flex flex-col bg-white {{ $loop->last ? '' : 'border-b border-gray-200' }} pb-4 sm:flex-row items-center">
                            <img class="hidden md:inline-block m-2 h-24 w-24 rounded-md border object-cover object-center"
                                src="{{ asset('storage/courses/' . $cart['main_image']) }}" alt="" />
                            <div class="flex w-full flex-col px-4">
                                <span class="text-lg">{{ $cart['name'] }}</span>
                                <div class="md:flex justify-between items-end mt-2">
                                    <div>
                                        <p class="text-gray-500">Periode Sewa:</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $cart['rent_month'] }} bulan
                                        </p>
                                    </div>
                                    <p class="text-sm font-light text-gray-500">Rp.
                                        {{ number_format($cart['price'], 0, ',', '.') }}
                                        /
                                        <span class="text-sm font-light">
                                            bulan
                                        </span>
                                    </p>
                                </div>
                                <hr class="my-2 opacity-25">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-light text-gray-500">Total</p>
                                    <p class="text-md">Rp. {{ number_format($cart['total_price'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <hr> --}}
                </div>
            </div>
        </div>
    </section>

    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                });
                localStorage.removeItem('cart');
                window.location.href =
                    "{{ auth()->user()->role == 2 ? route('institution.dashboard') : (auth()->user()->role == 3 ? route('user.dashboard') : route('dashboard')) }}";
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                });
            @endif
        </script>
    @endpush
</x-user-layout>
