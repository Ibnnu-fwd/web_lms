<x-app-layout>
    <x-breadcrumb name="course_chapter" :data="$course" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Materi" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.course-chapter.create', $course->id) }}" />
        </div>
        <table id="courseChapterTable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Pdf</th>
                    <th>Video</th>
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
                    text: `Kategori ${title} akan dinonaktifkan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.course-chapter.destroy', [$course->id, ':id']) }}";
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
                                        $('#courseChapterTable').DataTable().ajax.reload();
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
                    text: `Kategori ${title} akan diaktifkan kembali!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.course-chapter.restore', [$course->id, ':id']) }}";
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
                                        $('#courseChapterTable').DataTable().ajax.reload();
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
                $('#courseChapterTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.course-chapter.index', $course->id) }}',
                    columns: [{
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'pdf_file',
                            name: 'pdf_file'
                        },
                        {
                            data: 'video_file',
                            name: 'video_file'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
