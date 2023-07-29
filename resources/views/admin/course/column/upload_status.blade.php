@if ($data->request_status == 1)
    @if ($data->request_status == 0)
        <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">
            Tidak Dipublish
        </span>
    @elseif ($data->request_status == 1)
        <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-green-100 text-green-800">
            Dipublish
        </span>
    @endif
@else
    <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">
        Menunggu
    </span>
@endif
