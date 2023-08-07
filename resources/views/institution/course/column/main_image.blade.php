<a href="#image_preview" rel="modal:open"
    onclick="$('#imagePreview').attr('src', '{{ asset('storage/courses/' . $data->main_image) }}')">
    <img src="{{ asset('storage/courses/' . $data->main_image) }}"
        class="w-10
    h-10 object-cover object-center ring-1 ring-gray-300 rounded-md" alt="{{ $data->title }}">
</a>
