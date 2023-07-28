<x-app-layout>
    <x-breadcrumb name="course" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Kursus" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.course.create') }}" />
        </div>
        <table id="courseTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Status Request</th>
                    <th>Status Unggah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#courseTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.course.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'category',
                            name: 'category'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'main_image',
                            name: 'main_image'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'request_status',
                            name: 'request_status'
                        },
                        {
                            data: 'upload_status',
                            name: 'upload_status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
