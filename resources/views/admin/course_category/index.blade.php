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
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
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
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
