<x-app-layout>
    <x-breadcrumb name="quiz" :data="$courseChapter" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Quiz" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.quiz.create', $courseChapter->id) }}" />
        </div>
        <table id="quizTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Soal</th>
                    <th>Status</th>
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
                    text: `Quiz ${title} akan dinonaktifkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.quiz.destroy', [$courseChapter->id, ':id']) }}";
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
                                        $('#quizTable').DataTable().ajax.reload();
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

            function restore(id, title) {
                console.log(id, title);
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: `Quiz ${title} akan diaktifkan kembali!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.quiz.restore', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Materi ${title} berhasil diaktifkan kembali!`,
                                        icon: 'success',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $('#quizTable').DataTable().ajax.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: `Materi ${title} gagal diaktifkan kembali!`,
                                        icon: 'error',
                                    })
                                }
                            },
                        });
                    }
                })
            }
            $(function() {
                $('#quizTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.quiz.index', $courseChapter->id) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'question_count',
                            name: 'question_count'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
