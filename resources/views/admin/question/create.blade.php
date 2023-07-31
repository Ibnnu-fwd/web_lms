<x-app-layout>
    <x-breadcrumb name="question.create" :data="$quiz" />

    <x-card-container class="w-full xl:w-1/2">
        <form action="{{ route('admin.question.store', $quiz->id) }}" method="POST">
            @csrf
            <x-textarea id="question" name="question" label="Pertanyaan" required />
            <div class="md:grid grid-cols-2 gap-4 mb-4">
                <x-textarea id="option_a" name="option_a" label="Opsi A" required />
                <x-textarea id="option_b" name="option_b" label="Opsi B" required />
                <x-textarea id="option_c" name="option_c" label="Opsi C" />
                <x-textarea id="option_d" name="option_d" label="Opsi D" />
            </div>
            <x-select id="answer" name="answer" title="Jawaban" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </x-select>
            <x-button title="Tambah Pertanyaan" />
        </form>
    </x-card-container>
    @push('js-internal')
        <script>
            $(function() {
                // if c is answer, then d is required
                // if d is answer, then c is required
                $('#answer').change(function() {
                    if ($(this).val() == 'C') {
                        $('#option_c').attr('required', true);
                        $('#option_d').removeAttr('required');
                        $('#option_d').val('');
                    } else if ($(this).val() == 'D') {
                        $('#option_d').attr('required', true);
                        $('#option_c').attr('required', true);
                    } else {
                        $('#option_c').removeAttr('required');
                        $('#option_d').removeAttr('required');
                        $('#option_c').val('');
                        $('#option_d').val('');
                    }
                });
            });
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('admin.question.index', $quiz->id) }}"
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
