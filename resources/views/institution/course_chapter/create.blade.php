<x-app-layout>
    <x-breadcrumb name="course_chapter.create" :data="$course" />
    <x-card-container class="w-full xl:w-1/2 2xl:w-1/3">
        <form action="{{ route('admin.course-chapter.store', $course->id) }}" method="POST">
            @csrf
            <x-input id="title" name="title" label="Judul" type="text" required />
            <x-textarea id="description" name="description" label="Deskripsi" required />
            <x-button title="Tambah Materi" />
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
                }).then(() => {
                    window.location.href = '{{ route('admin.course-chapter.index', $course->id) }}';
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
