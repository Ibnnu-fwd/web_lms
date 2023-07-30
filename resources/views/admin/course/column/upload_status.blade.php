@if ($data->request_status == 1)
    @if ($data->request_status == 0)
        <span class="uppercase">
            Tidak Dipublish
        </span>
    @elseif ($data->request_status == 1)
        <span class="uppercase text-success">
            Dipublish
        </span>
    @endif
@else
    <span class="uppercase">
        Menunggu
    </span>
@endif
