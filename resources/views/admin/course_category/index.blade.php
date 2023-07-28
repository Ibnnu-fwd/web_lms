<x-app-layout>
    <x-breadcrumb name="course_category" />
    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Kategori" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.course-category.create') }}" />
        </div>
        <table id="courseCategoryTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ikon</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function destroy(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: `Kategori ${name} akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.course-category.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Kategori ${name} berhasil dihapus!`,
                                        icon: 'success',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $('#courseCategoryTable').DataTable().ajax.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: `Kategori ${name} gagal dihapus!`,
                                        icon: 'error',
                                    })
                                }
                            },
                        });
                    }
                })
            }

            $(function() {
                $('#courseCategoryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.course-category.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'icon',
                            name: 'icon'
                        },
                        {
                            data: 'name',
                            name: 'name'
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
