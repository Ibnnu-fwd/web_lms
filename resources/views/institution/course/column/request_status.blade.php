@if ($data->request_status == 0)
    <span class="uppercase">
        menunggu
    </span>
@elseif ($data->request_status == 1)
    <span class="uppercase text-success">
        diterima
    </span>
@elseif ($data->request_status == 2)
    <span class="uppercase text-danger">
        ditolak
    </span>
@endif
