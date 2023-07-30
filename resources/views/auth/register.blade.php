<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-24 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm cursor-pointer" onclick="window.location.href='/'">
            <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Your Company">
            {{-- <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Buat Akun
            </h2> --}}
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <x-input id="email" label="Email" name="email" type="email" required />
                <x-input id="password" label="Kata sandi" name="password" type="password" required />

                <x-button title="Daftar" />
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium leading-6 text-primary hover:text-indigo-500">
                    Masuk
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
