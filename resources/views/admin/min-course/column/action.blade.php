<div class="gap-2">
    <x-edit-button route="{{ route('admin.mincourse.edit', $data->id) }}" />
    <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->name }}')" />
</div>
