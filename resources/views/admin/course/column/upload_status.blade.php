@if ($data->request_status == 1)
    @if ($data->upload_status == 0)
        <span class="uppercase">
            Tidak Dipublish
        </span>
    @elseif ($data->upload_status == 1)
        <span class="uppercase text-success">
            Dipublish
        </span>
    @endif
@else
    <span class="uppercase">
        -
    </span>
@endif
