<x-user-layout>

    <section class="py-12 bg-gray-50">
        <div class="md:text-center">
            <p class="text-lg md:text-2xl text-black font-bold">
                Simpel, Cepat, dan Mudah
            </p>
            <p class=" mt-2 text-sm md:text-lg tracking-tight text-gray-600">
                Ikuti langkah-langkah berikut untuk memesan kelas di <b>{{ config('app.name') }}</b>
            </p>
        </div>

        <div class="flex flex-col justify-center m-auto">
            <div class="flex flex-col justify-center text-center md:flex-row md:text-left">
                <div class="flex flex-col justify-center max-w-2xl p-10 space-y-12">
                    <article>
                        <span class="inline-flex items-center text-black rounded-xl">
                            <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="add-circle" role="img">
                            </ion-icon>
                        </span>
                        <div class="mt-3 text-xl tracking-tighter text-black">
                            Pilih Kelas
                        </div>
                        <div class="mt-4 text-gray-500">
                            Cari dan pilih kelas yang kamu inginkan, lalu klik tombol "Pesan Kelas". Kamu akan diarahkan
                            ke
                            halaman checkout.
                        </div>
                    </article>
                    <article>
                        <span class="inline-flex items-center text-black rounded-xl">
                            <span class="text-sm" aria-hidden="true">
                                <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="time" role="img">
                                </ion-icon>
                            </span>
                        </span>
                        <div class="mt-3 text-xl tracking-tighter text-black">
                            Menentukan Waktu Sewa
                        </div>
                        <div class="mt-4 text-gray-500">
                            Waktu sewa dapat kamu tentukan sendiri, mulai dari bulanan sampai tahunan. <b>Pilihan waktu
                                sewa
                                akan mempengaruhi harga sewa.</b>
                        </div>
                    </article>
                    <article>
                        <span class="inline-flex items-center text-black rounded-xl">
                            <span class="text-sm" aria-hidden="true">
                                <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="checkmark-circle" role="img">
                                </ion-icon>
                            </span>
                        </span>
                        <div class="mt-3 text-xl tracking-tighter text-black">
                            Checkout
                        </div>
                        <div class="mt-4 text-gray-500">
                            Setelah menentukan waktu sewa, kamu akan diarahkan ke halaman checkout. Pada halaman ini
                            kamu
                            dapat melihat detail pesanan dan melakukan pembayaran dengan sistem upload bukti transfer
                            yang
                            kemudian akan diverifikasi oleh admin.
                        </div>
                    </article>
                    <article>
                        <span class="inline-flex items-center text-black rounded-xl">
                            <span class="text-sm" aria-hidden="true">
                                <ion-icon class="w-6 h-6 text-red-500 md hydrated mr-2" name="key" role="img">
                                </ion-icon>
                            </span>
                        </span>
                        <div class="mt-3 text-xl tracking-tighter text-black">
                            Course Access
                        </div>
                        <div class="mt-4 text-gray-500">
                            Kamu akan mendapatkan akses ke kelas yang kamu pesan setelah pembayaran diverifikasi oleh
                            admin
                            melalui <b>email</b>. Kamu dapat mengakses kelas melalui halaman dashboard.
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</x-user-layout>
