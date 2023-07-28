<div class="gap-2">
    <x-edit-button route="{{ route('admin.verificator.edit', $data->id) }}" />
    <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->fullname }}')" />
</div>
