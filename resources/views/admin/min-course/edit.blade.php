<x-app-layout>
    <x-breadcrumb name="mincourse.edit" :data="$minCourse" />

    <x-card-container class="w-full md:w-1/3">
        <form action="{{ route('admin.mincourse.edit') }}" method="POST">
            @csrf
            @method('PUT')
            <x-input id="name" type="text" name="name" label="Nama" value="{{ $minCoursePurchaseAtReg->name }}"
                required />
            <x-input id="value" type="text" name="value" label="Jumlah"
                value="{{ $minCoursePurchaseAtReg->value }}" required />
            <x-button title="Tambah Data Minimum" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                }).then((result) => {
                    window.location.href = "{{ route('admin.mincourse.index') }}"
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
