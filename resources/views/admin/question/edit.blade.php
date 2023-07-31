<x-app-layout>
    <x-breadcrumb name="question.edit" :data="$question" />

    <x-card-container class="w-full xl:w-1/2">
        <form action="{{ route('admin.question.update', [$question->quiz_id, $question->id]) }}" method="POST">
            @csrf
            @method('PUT')
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
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>
    @push('js-internal')
        <script>
            $(function() {
                $('#question').val('{{ $question->question }}');
                $('#option_a').val('{{ $question->option_a }}');
                $('#option_b').val('{{ $question->option_b }}');
                $('#option_c').val('{{ $question->option_c }}');
                $('#option_d').val('{{ $question->option_d }}');
                $('#answer').append(
                    '<option value="{{ $question->answer }}" selected>{{ $question->answer }}</option>');
            });
        </script>
        <script>
            $(function() {
                $('#answer').change(function() {
                    let answerVal = $(this).val();
                    $('#option_c').removeAttr('required');
                    $('#option_d').removeAttr('required');
                    $('#option_c, #option_d').val('');

                    if (answerVal === 'C') {
                        $('#option_c').attr('required', true);
                    } else if (answerVal === 'D') {
                        $('#option_c').attr('required', true);
                        $('#option_d').attr('required', true);
                    }
                });

                $('form').submit(function(e) {
                    e.preventDefault();
                    let answerVal = $('#answer').val();
                    let optionCVal = $('#option_c').val();
                    let optionDVal = $('#option_d').val();

                    if (answerVal === 'C' && optionCVal === '') {
                        showErrorMessage('Opsi C harus diisi');
                    } else if (answerVal === 'D' && optionDVal === '') {
                        showErrorMessage('Opsi D harus diisi');
                    } else {
                        this.submit();
                    }
                });

                function showErrorMessage(message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: message,
                    });
                }
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
