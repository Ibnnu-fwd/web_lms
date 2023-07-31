<div class="flex items-center">
    <x-edit-button route="{{ route('admin.question.edit', [$data->quiz_id, $data->id]) }}" />
    <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->question }}')" />
    {{-- <x-link-button route="{{ route('admin.course-chapter.index', $data->id) }}" title="Materi" color="dark" /> --}}
</div>
