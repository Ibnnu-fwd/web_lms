<x-app-layout>
    <x-breadcrumb name="mincourse.edit" :data="$minCourse" />

    <div class="md:grid xl:w-1/2 2xl:w-1/3 gap-8 space-y-6 md:space-y-0">
        <x-card-container>
            <h2 class="font-semibold text-lg mb-6">
                Informasi Minimum Produk
            </h2>

            <form action="{{ route('admin.mincourse.update', $minCourse->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-input id="name" name="name" type="text" label="Nama" :value="$minCourse->name" required />
                <x-input id="value" name="value" type="text" label="Nilai" :value="$minCourse->value" required />
                <x-button title="Simpan Perubahan" id="updateButton" />
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: `{{ Session::get('success') }}`,
                    icon: 'success',
                    showConfirmButton: false,
                }).then((result) => {
                    window.location.href = "{{ route('admin.mincourse.index') }}"
                })
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: `{{ Session::get('error') }}`,
                    icon: 'error',
                })
            @endif
        </script>
    @endpush

</x-app-layout>
