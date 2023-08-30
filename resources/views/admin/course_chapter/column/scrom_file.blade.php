@if ($data->scrom_file)
    <a class="text-success cursor-pointer uppercase"
        href="{{ asset('storage/course/chapter/scrom/scrom_extracted/' . $data->scrom_file . '/index.html') }}" target="_blank">
        Lihat
    </a>
@else
    <span>-</span>
@endif
