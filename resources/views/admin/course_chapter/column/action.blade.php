<div class="flex items-center gap-x-2">
    @if ($data->is_active)
        <x-edit-button route="{{ route('admin.course-chapter.edit', [$data->course_id, $data->id]) }}" />
        <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->title }}')" />
        <x-link-button color="dark" route="{{ route('admin.quiz.index', [$data->id]) }}"
            title="{{ $data->quiz->count() > 0 ? 'Edit Quiz' : 'Tambah Quiz' }}" />
    @else
        <x-restore-button onclick="restore('{{ $data->id }}', '{{ $data->title }}')" />
    @endif
</div>
