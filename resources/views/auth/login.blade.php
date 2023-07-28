<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex min-h-full flex-col justify-center px-6 py-24 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm cursor-pointer" onclick="window.location.href='/'">
            <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Your Company">
            {{-- <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Masuk ke akun anda
            </h2> --}}
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <x-input id="email" label="Email" name="email" type="email" required />
                <x-input id="password" label="Kata sandi" name="password" type="password" required />

                <x-button title="Masuk" class="w-full" />
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-primary hover:text-indigo-500">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>

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
</x-guest-layout>
