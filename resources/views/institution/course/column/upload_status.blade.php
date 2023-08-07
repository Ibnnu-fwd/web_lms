@if ($data->request_status == 1)
    @if ($data->upload_status == 0)
        <x-link-button onclick="publish('{{ $data->id }}', '{{ $data->title }}')" color="success"
            title="PUBLISH" />
    @elseif ($data->upload_status == 1)
        <x-link-button onclick="unpublish('{{ $data->id }}', '{{ $data->title }}')" color="dark"
            title="UNPUBLISH" />
    @endif
@else
    <span class="uppercase">
        -
    </span>
@endif
