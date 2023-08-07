<div class="flex items-center">
    <x-edit-button route="{{ route('admin.course-category.edit', $data->id) }}" />
    <x-delete-button onclick="destroy('{{ $data->id }}', '{{ $data->name }}')" />
</div>
