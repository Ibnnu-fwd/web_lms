<div class="flex items-center">
    <x-edit-button route="{{ route('admin.course-chapter.edit', [$data->course_id, $data->id]) }}" />
    @if ($data->is_active)
        <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->title }}')" />
        <x-link-button color="dark" route="{{ route('admin.course-sub-chapter.index', $data->id) }}"
            title="Sub Materi" />
    @else
        <x-restore-button onclick="restore('{{ $data->id }}', '{{ $data->title }}')" />
    @endif
</div>
