@if ($data->scrom_file)
    <a class="text-success cursor-pointer uppercase"
        href="{{ asset('storage/course/chapter/scrom_file/' . $data->scrom_file) }}" target="_blank">
        Lihat
    </a>
@else
    <span>-</span>
@endif
