<x-app-layout>
    <x-breadcrumb name="user-transaction" />
    <x-card-container>
        <div class="text-end mb-4">
        </div>
        <table id="courseCategoryTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe Transaksi</th>
                    <th>Customer</th>
                    <th>Sub Total</th>
                    <th>Total Pembayaran</th>
                    <th>Status Pemesanan</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal</th>
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
