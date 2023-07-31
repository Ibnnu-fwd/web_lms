<x-app-layout>
    <x-breadcrumb name="question" :data="$quiz" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Soal" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.question.create', $quiz->id) }}" />
        </div>
        <table id="questionTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Soal</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>Jawaban Benar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function destroy(id, title) {
                console.log(id, title);
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: `Soal ${title} akan dinonaktifkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.question.destroy', [$quiz->id, ':id']) }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Materi ${title} berhasil dihapus!`,
                                        icon: 'success',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $('#questionTable').DataTable().ajax.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: `Materi ${title} gagal dihapus!`,
                                        icon: 'error',
                                    })
                                }
                            },
                        });
                    }
                })
            }
            $(function() {
                $('#questionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.question.index', $quiz->id) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'question',
                            name: 'question'
                        },
                        {
                            data: 'option_a',
                            name: 'option_a'
                        },
                        {
                            data: 'option_b',
                            name: 'option_b'
                        },
                        {
                            data: 'option_c',
                            name: 'option_c'
                        },
                        {
                            data: 'option_d',
                            name: 'option_d'
                        },
                        {
                            data: 'answer',
                            name: 'answer'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
