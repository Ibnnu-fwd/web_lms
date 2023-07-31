<div class="flex items-center gap-x-2">
    @if ($data->request_status == 0)
        <x-link-button onclick="approve('{{ $data->id }}', '{{ $data->title }}')" color="success" title="SETUJU" />
        <x-link-button onclick="reject('{{ $data->id }}', '{{ $data->title }}')" color="dark" title="TOLAK" />
    @endif
</div>
