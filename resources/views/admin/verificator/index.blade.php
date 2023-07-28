<x-app-layout>
    <x-breadcrumb name="verificator" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah verifikator" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.verificator.create') }}" />
        </div>
        <table id="verificatorTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama lengkap</th>
                    <th>Email</th>
                    <th>Bergabung sejak</th>
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
                    text: `Verifikator ${name} akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.verificator.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: `Verifikator ${name} berhasil dihapus!`,
                                        icon: 'success',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $('#verificatorTable').DataTable().ajax.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: `Verifikator ${name} gagal dihapus!`,
                                        icon: 'error',
                                    })
                                }
                            },
                        });
                    }
                })
            }
            $(function() {
                $('#verificatorTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: "{{ route('admin.verificator.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
