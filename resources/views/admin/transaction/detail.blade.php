<x-app-layout>
    <x-breadcrumb name="transaction.detail" :data="$transaction" />
    <section class="max-w-2xl mx-auto">
        <x-card-container>
            <div class="mt-10 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium mb-2">Detail Transaksi</p>
                <div class="mt-6">
                    <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                        Email
                    </label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder" disabled
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-xs 2xl:text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="Your full name here" value="{{ $transaction->customer->email }}" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <ion-icon name="mail-outline"></ion-icon>
                        </div>
                    </div>
                    <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                        Nama
                    </label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder" disabled
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-xs 2xl:text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                            placeholder="Your full name here" value="{{ $transaction->customer->fullname }}" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <ion-icon name="person-outline"></ion-icon>
                        </div>
                    </div>

                    {{-- info pesanan kelas --}}
                    <div class="mt-6">
                        <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                            Kelas yang di pesan
                        </label>

                        @foreach ($transaction->detailTransaction as $detailTransaction)
                            <div class="flex mb-4 items-center">
                                <img src="{{ $detailTransaction->course->main_image
                                    ? Storage::url('courses/' . $detailTransaction->course->main_image)
                                    : asset('images/course-default.png') }}"
                                    alt="class image"
                                    class="hidden md:inline-block w-16 h-1w-16 rounded-md object-center object-cover">
                                <div class="md:ml-4 mt-2">
                                    <p class="text-md font-medium">
                                        {{ $detailTransaction->course->title }}
                                    </p>
                                    <p class="text-sm text-gray-400">
                                        {{ $detailTransaction->total_month . ' bulan' }} @ Rp.
                                        {{ number_format($detailTransaction->course->price, '0', ',', '.') }}
                                    </p>
                                </div>
                                {{-- harga --}}

                                <div class="ml-auto mt-2 text-right">
                                    <p class="text-xs 2xl:text-sm font-medium">
                                        {{ $transaction->getStatusPaymentLabel() }}</p>
                                    <p class="text-xs 2xl:text-sm font-light">
                                        Rp.{{ number_format($detailTransaction->total_payment, '0', ',', '.') }}
                                    </p>

                                </div>

                            </div>
                        @endforeach

                        <!-- Total -->
                        <div class="mt-6 border-t py-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-900">Kode Pembayaran</p>
                                <p class="text-md text-gray-900">{{ $transaction->transaction_code }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-900">Sub Total</p>
                                <p class="text-md text-gray-900">Rp.
                                    <span>{{ number_format($transaction->sub_total, '0', ',', '.') }}</span></p>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-sm text-gray-900">Total</p>
                            <p class="text-md font-medium text-gray-900">Rp.
                                <span>
                                    {{ number_format($transaction->total_payment, '0', ',', '.') }}
                                </span>
                            </p>
                        </div>

                    </div>

                    @if ($transaction->status_payment == 0)
                    @elseif($transaction->status_payment == 1)
                        <div class="mt-4">
                            <p class="text-xs 2xl:text-sm mb-4 font-medium mt-4">Bukti Pembayaran</p>
                            <img class="w-20 h-20 object-cover object-center border-gray-300 border-2 rounded-md"
                                onclick="window.open('{{ asset('storage/proof_payment/' . $transaction->payment_proof) }}')"
                                src="{{ asset('storage/proof_payment/' . $transaction->payment_proof) }}"
                                alt="proof payment" />
                        </div>
                        <form action="{{ route('admin.transaction.approve', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="mt-8 mb-2 w-full text-lg uppercase text-center rounded-md bg-success px-6 py-3 font-medium text-white">
                                Konfirmasi Pembayaran</button>
                        </form>

                        <form action="{{ route('admin.transaction.decline', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="mb-8 w-full text-lg uppercase text-center rounded-md bg-danger px-6 py-3 font-medium text-white">
                                Tolak Pembayaran</button>
                        </form>
                    @elseif($transaction->status_payment == 2)
                        <div
                            class="mt-8 mb-8 w-full text-lg uppercase text-center rounded-md bg-green-500 px-6 py-3 font-medium text-white">
                            Pembayaran Diterima</div>
                    @elseif($transaction->status_payment == 3)
                        <div
                            class="mt-8 mb-8 w-full text-lg uppercase text-center rounded-md bg-red-500 px-6 py-3 font-medium text-white">
                            Pembayaran Ditolak</div>
                    @endif

                </div>
            </div>
        </x-card-container>
    </section>

    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
</x-app-layout>
