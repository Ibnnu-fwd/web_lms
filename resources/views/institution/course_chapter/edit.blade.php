<x-app-layout>
    <x-breadcrumb name="course_chapter.edit" :data="$course_chapter" />
    <x-card-container class="w-full xl:w-1/2 2xl:w-1/3">
        <form action="{{ route('admin.course-chapter.update', [$course_id, $course_chapter->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-input id="title" name="title" label="Judul" type="text" :value="$course_chapter->title" required />
            <x-textarea id="description" name="description" label="Deskripsi" required>{{ $course_chapter->description }}
            </x-textarea>
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
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = '{{ route('admin.course-chapter.index', $course_id) }}';
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
