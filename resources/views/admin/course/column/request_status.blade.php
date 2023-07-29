@if ($data->request_status == 0)
    <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">
        Menunggu
    </span>
@elseif ($data->request_status == 1)
    <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-green-100 text-green-800">
        Disetujui
    </span>
@elseif ($data->request_status == 2)
    <span class="px-2 inline-flex text-md leading-5 font-medium rounded-full bg-red-100 text-red-800">
        Ditolak
    </span>
@endif
