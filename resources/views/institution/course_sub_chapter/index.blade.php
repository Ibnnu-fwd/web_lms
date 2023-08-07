<x-app-layout>
    <x-breadcrumb name="course_sub_chapter" :data="$courseChapter" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah Sub Materi" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.course-sub-chapter.create', $courseChapter->id) }}" />
        </div>
        <table id="courseSubChapterTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>File</th>
                    <th>Video</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#courseSubChapterTable').DataTable({
                    processing: true,
                    serverSide: true,
                    reponsive: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.course-sub-chapter.index', $courseChapter->id) }}',
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
                            data: 'file',
                            name: 'file'
                        },
                        {
                            data: 'video',
                            name: 'video'
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
