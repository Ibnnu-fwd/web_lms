<x-app-layout>
    <x-breadcrumb name="account" />
    <x-card-container class="w-full md:w-1/3">
        <h2 class="text-lg font-medium">
            Informasi Akun
        </h2>
        <p class="text-md mt-1 mb-4 text-gray-400">
            Ubah informasi akun anda
        </p>

        <form action="" method="POST">
            @csrf
            @method('PUT')

            <x-input id="email" name="email" label="Email" type="email" value="{{ auth()->user()->email }}"
                required />
            <x-input id="password" name="password" label="Password Lama" type="password" required />
            <x-input id="password" name="password" label="Password Baru" type="password" required />
            <x-input id="password_confirmation" name="password_confirmation" label="Konfirmasi Password Baru"
                type="password" required />
            <hr class="my-4">
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>
</x-app-layout>
