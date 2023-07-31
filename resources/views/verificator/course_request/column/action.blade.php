<div class="flex items-center gap-x-2">
    @if ($data->request_status == 0)
        <x-link-button onclick="approve('{{ $data->id }}', '{{ $data->title }}')" color="success" title="SETUJU" />
        <x-link-button onclick="reject('{{ $data->id }}', '{{ $data->title }}')" color="dark" title="TOLAK" />
    @endif

    @if ($data->request_status == 1 || $data->request_status == 2)
        <x-link-button onclick="pending('{{ $data->id }}', '{{ $data->title }}')" color="warning" title="PENDING" />
    @endif
</div>
