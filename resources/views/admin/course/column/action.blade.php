<div class="gap-2">
    <x-edit-button route="{{ route('admin.course.edit', $data->id) }}" />
    <x-link-button route="{{ route('admin.course-chapter.index', $data->id) }}" title="Materi" color="dark" />
</div>
