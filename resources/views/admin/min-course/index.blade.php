<x-app-layout>
    <x-breadcrumb name="mincourse" />
    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Minimum Kursus" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.mincourse.create') }}" />
        </div>
        <table id="minCourseTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            function destroy(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: `Data ${name} akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.mincourse.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Data ${name} berhasil dihapus!`,
                                        icon: 'success',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $('#minCourseTable').DataTable().ajax.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: `Data ${name} gagal dihapus!`,
                                        icon: 'error',
                                    })
                                }
                            },
                        });
                    }
                })
            }

            $(function() {
                $('#minCourseTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.mincourse.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'value',
                            name: 'value'
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
