<div class="flex items-center">
    <x-edit-button route="{{ route('admin.course-sub-chapter.edit', [$data->course_chapter_id, $data->id]) }}" />
    <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->title }}')" />
</div>
