@if ($data->pdf_file)
    <a class="text-success cursor-pointer uppercase" href="{{ asset('storage/course/chapter/pdf/' . $data->pdf_file) }}"
        target="_blank">
        Lihat
    </a>
@endif
