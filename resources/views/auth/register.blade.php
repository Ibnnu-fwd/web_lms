<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-10 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm cursor-pointer" onclick="window.location.href='/'">
            <img class="mx-auto h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Your Company">
            {{-- <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Buat Akun
            </h2> --}}
        </div>
        <section class="flex min-h-full flex-col justify-between px-6 :px-8">
            <div class="items-center px-8 mx-auto max-w-7xl lg:px-16 md:px-12">
                <div class="justify-between w-full lg:p-10 max-auto">
                    <div x-data="{ tab: 'tab1' }">
                        <ul class="grid grid-cols-2 mx-auto text-sm text-center text-black border-b">
                            <li class="w-full -mb-px">
                                <a @click.prevent="tab = 'tab1'" href="#"
                                    class="inline-block py-2 font-medium ´ border-b-2 px-6 w-full border-transaprent bg-white text-primary border-primary"
                                    :class="{ ' bg-white text-primary  border-primary': tab === 'tab1' }">
                                    Register Sebagai Personal
                                </a>
                            </li>
                            <li class="w-full -mb-px">
                                <a @click.prevent="tab = 'tab2'" href="#"
                                    class="inline-block py-2 font-medium ´ border-b-2 px-6 w-full border-transaprent"
                                    :class="{ ' bg-white text-primary  border-primary': tab === 'tab2' }">
                                    Register Sebagain Instansi
                                </a>
                            </li>
                        </ul>
                        <div class="text-left bg-white content">
                            <div x-show="tab==='tab1'" class="text-gray-500">
                                <main>
                                    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                                        <form class="space-y-6" action="#" method="POST">
                                            <x-input id="fullname" label="Nama Lengkap" name="fullname" type="text"
                                                required />
                                            <x-input id="email" label="Email" name="email" type="email"
                                                required />
                                            <x-input id="password" label="Kata sandi" name="password" type="password"
                                                required />

                                            <x-select id="gender" title="Gender" name="gender" class="w-full"
                                                required>
                                                <option value="L">Laki Laki</option>
                                                <option value="P">Perempuan</option>
                                            </x-select>
                                            <x-input id="birthday" label="Tanggal Lahir" name="birthday"
                                                type="birthday" required />
                                            <x-input id="phone" label="No.Telephone" name="phone" type="phone"
                                                required />
                                            <x-input id="job" label="Pekerjaan" name="job" type="job" />
                                            <x-input id="institution" label="Institusi" name="institution"
                                                type="institution" />
                                            <x-button title="Daftar" />
                                        </form>
                                    </div>
                                </main>
                            </div>
                            <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                                <main>
                                    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                                        <form class="space-y-6" action="#" method="POST">
                                            <x-input id="fullname" label="Nama Lengkap" name="fullname" type="text"
                                                required />
                                            <x-input id="email" label="Email" name="email" type="email"
                                                required />
                                            <x-input id="password" label="Kata sandi" name="password" type="password"
                                                required />

                                            <x-select id="gender" title="Gender" name="gender" class="w-full"
                                                required>
                                                <option value="L">Laki Laki</option>
                                                <option value="P">Perempuan</option>
                                            </x-select>
                                            <x-input id="birthday" label="Tanggal Lahir" name="birthday"
                                                type="birthday" required />
                                            <x-input id="phone" label="No.Telephone" name="phone" type="phone"
                                                required />
                                            <x-input id="job" label="Pekerjaan" name="job" type="job"
                                                required />
                                            <x-input id="institution" label="Institusi" name="institution"
                                                type="institution" required />

                                            <x-input-file id="file" label="File" name="file" required />

                                            <x-button title="Daftar" />
                                        </form>

                                    </div>
                                </main>
                            </div>
                        </div>
                        <p class="mt-10 text-center text-sm text-gray-500">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="font-medium leading-6 text-primary hover:text-indigo-500">
                                Masuk
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $("#birthday").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd',
                });
            });
        </script>
    @endpush
</x-guest-layout>
