<x-app-layout>
    <x-breadcrumb name="quiz.create" :data="$courseChapter" />

    <x-card-container class="w-full md:w-1/3">
        <form action="{{ route('admin.quiz.update', [$courseChapter->id, $quiz->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-input id="title" name="title" label="Judul" type="text" :value="$quiz->title" required />
            <x-textarea id="description" name="description" label="Deskripsi"
                required>{{ $quiz->description }}</x-textarea>
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('admin.quiz.index', $courseChapter->id) }}"
                    }
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
