<div class="flex items-center">
    @if ($data->activation_status)
        <x-edit-button route="{{ route('admin.course.edit', $data->id) }}" />
        <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->title }}')" />
        <x-link-button route="{{ route('admin.course-chapter.index', $data->id) }}" title="Materi" color="dark" />
    @else
        <x-restore-button onclick="restore('{{ $data->id }}', '{{ $data->title }}')" />
    @endif
</div>
