<x-app-layout>
    <x-breadcrumb name="user-transaction-detail" :route="'user.transaction.detail'" :data="$transaction" />
    <section class="xl:grid grid-cols-2 gap-8 space-y-6 md:space-y-0">
        <x-card-container>
            <div class="mt-10 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium">Detail Pembayaran</p>
                <p class="text-gray-400">Lengkapi pesanan Anda dengan memberikan detail pembayaran Anda.</p>
                <div class="mt-6">
                    <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                        Nama
                    </label>
                    <div class="relative">
                        <input type="text" id="card-holder" name="card-holder" disabled
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
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

                        <div class="flex ">
                            <img src="https://plus.unsplash.com/premium_photo-1673283380425-0f41f67db1c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8&auto=format&fit=crop&w=500&q=60"
                                alt="class image" class="w-20 h-20 rounded-md object-cover">
                            <div class="ml-4 mt-2">
                                <p class="text-md font-medium mb-3">Fundamental Php</p>
                                <p class="text-sm text-gray-400">1 bulan</p>
                            </div>
                            {{-- harga --}}

                            <div class="ml-auto mt-2 text-right">
                                <p class="text-md font-medium mb-3">{{ $transaction->getStatusPaymentLabel() }}</p>
                                <p class="text-md font-light mb-3">20000</p>

                            </div>

                        </div>

                        <!-- Total -->
                        <div class="mt-6 border-t py-4">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-900">Kode Pembayaran</p>
                                <p class="text-md text-gray-900">{{ $transaction->transaction_code }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-900">Sub Total</p>
                                <p class="text-md text-gray-900">Rp. <span>{{ $transaction->sub_total }}</span></p>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-sm text-gray-900">Total</p>
                            <p class="text-xl font-medium text-gray-900">Rp.
                                <Span>{{ $transaction->total_payment }}</Span>
                            </p>
                        </div>

                    </div>

                    @if ($transaction->status_payment == 0)
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="card-holder" class="mt-4 mb-2 block text-xs 2xl:text-sm">
                                Unggah Bukti Pembayaran
                            </label>
                            <div class="relative">
                                <input type="file" id="card-holder" name="proof_payment"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-primary focus:ring-primary"
                                    placeholder="Your full name here" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>
                            </div>
                            <button
                                class="mt-8 mb-8 w-full text-lg rounded-md bg-primary px-6 py-3 font-medium text-white">Unggah
                                Bukti Pembayaran</button>
                        </form>
                    @elseif($transaction->status_payment == 1)
                        <div class="mt-8 mb-8 w-full text-lg rounded-md bg-green-500 px-6 py-3 font-medium text-white">
                            Menunggu Konfirmasi Pembayaran</div>
                    @elseif($transaction->status_payment == 2)
                        <div class="mt-8 mb-8 w-full text-lg rounded-md bg-green-500 px-6 py-3 font-medium text-white">
                            Pembayaran Diterima</div>
                    @elseif($transaction->status_payment == 3)
                        <div class="mt-8 mb-8 w-full text-lg rounded-md bg-red-500 px-6 py-3 font-medium text-white">
                            Pembayaran Ditolak</div>
                    @endif

                </div>
            </div>
        </x-card-container>
    </section>
</x-app-layout>
