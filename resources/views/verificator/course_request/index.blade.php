<x-app-layout>
    <x-breadcrumb name="course-request" />

    <x-card-container>
        <table id="courseRequestTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Jumlah Materi</th>
                    <th>Kontributor</th>
                    <th>Harga</th>
                    <th>Status Permintaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>
    @push('js-internal')
        <script>
            function approve(id, title) {
                Swal.fire({
                    icon: 'warning',
                    text: `Apakah anda yakin ingin menyetujui permintaan kursus ${title}?`,
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('verificator.course-request.approve') }}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Permintaan kursus berhasil disetujui',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    $('#courseRequestTable').DataTable().ajax.reload();
                                })
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Permintaan kursus gagal disetujui',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                })
            }
            $(function() {
                $('#courseRequestTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('verificator.course-request.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            align: 'center',
                            width: '5%'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            align: 'center',
                            width: '10%'
                        },
                        {
                            data: 'title',
                            name: 'title',
                            width: '20%'
                        },
                        {
                            data: 'category',
                            name: 'category',
                            width: '10%'
                        },
                        {
                            data: 'chapter_count',
                            name: 'chapter_count',
                            width: '10%',
                            align: 'center'
                        },
                        {
                            data: 'contributor',
                            name: 'contributor',
                            width: '15%'
                        },
                        {
                            data: 'price',
                            name: 'price',
                            width: '10%',
                            align: 'center'
                        },
                        {
                            data: 'request_status',
                            name: 'request_status',
                            width: '10%',
                            align: 'center'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            align: 'center',
                            width: '10%'
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
