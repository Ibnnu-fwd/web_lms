@if ($data->scrom_file)
    <a class="text-success cursor-pointer uppercase"
        href="{{ asset('storage/app/public/course/chapter/scrom/scrom_extracted/' . $data->scrom_file) }}" target="_blank">
        Lihat
    </a>
@else
    <span>-</span>
@endif
