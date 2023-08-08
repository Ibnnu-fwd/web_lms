@if ($data->video_file)
    <a class="text-success cursor-pointer uppercase"
        href="{{ asset('storage/course/chapter/video/' . $data->video_file) }}" target="_blank">
        Lihat
    </a>
@endif
