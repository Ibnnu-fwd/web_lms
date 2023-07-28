<x-app-layout>
    <x-breadcrumb name="profile" />
    <x-card-container class="w-full md:w-1/3 grid grid-cols-3 gap-4">
        <img src="{{ asset('images/no_image.jpg') }}" alt="" class="w-full h-38 object-cover rounded-lg">

        <form class="col-span-2" action="{{ route('admin.profile.update', auth()->user()->id) }}" method="POST">
            @csrf
            <x-input id="fullname" label="Fullname" name="fullname" type="text" value="{{ auth()->user()->fullname }}"
                required />
            <x-select id="gender" title="Gender" name="gender" class="w-full">
                <option value="L">Laki Laki</option>
                <option value="P">Perempuan</option>
            </x-select>
            <x-input id="birthday" label="Tanggal Lahir" name="birthday" type="text"
                value="{{ auth()->user()->birthday }}" />
            <x-input id="phone" label="No Telephone" name="phone" type="text"
                value="{{ auth()->user()->phone }}" />
            <x-input id="job" label="Pekerjaan" name="job" type="text" value="{{ auth()->user()->job }}" />
            <x-input id="institution" label="Institusi" name="institution" type="text"
                value="{{ auth()->user()->institution }}" />
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>

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
