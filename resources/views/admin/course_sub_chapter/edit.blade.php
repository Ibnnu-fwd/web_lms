<x-app-layout>
    <x-breadcrumb name="course_sub_chapter.edit" :data="$courseSubChapter" />

    <div class="md:grid 2xl:grid-cols-3 gap-4 2xl:gap-x-8">
        <x-card-container>
            <div class="text-gray-600">
                <p class="font-medium text-md">
                    Materi Praktik
                </p>
                <p class="text-xs 2xl:text-sm">
                    Lengkapi data materi teori dengan benar.
                </p>
                <div class="mt-8">
                    <x-input id="title" name="title" type="text" label="Judul Materi" />
                    {{-- only pdf --}}
                    <x-input id="file" name="file" type="file" label="File Materi Teori"
                        accept="application/pdf" />
                    <x-input id="video" name="video" type="file" label="File Materi Praktikum"
                        accept="video/*" />

                    <x-button title="Simpan Perubahan" />
                </div>
            </div>
        </x-card-container>
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Teori
                </h2>
                @if ($courseSubChapter->file != null)
                    <x-button color="dark" title="Hapus File" type="button" onclick="deleteFile()" />
                @endif
            </div>
            <embed src="" class="w-full rounded-lg" style="height: 600px">
        </div>
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Praktikum
                </h2>
                @if ($courseSubChapter->video != null)
                    <x-button color="dark" title="Hapus File" type="button" onclick="deleteVideo()" />
                @endif
            </div>
            <iframe src="" frameborder="0" style="height: 300px"></iframe>
        </div>
    </div>

    @push('js-internal')
        <script>
            function deleteFile() {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "File materi teori akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.course-sub-chapter.delete-file', $courseSubChapter->id) }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.message,
                                    });
                                }
                            },
                        });
                    }
                })
            }

            function deleteVideo() {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "File materi praktikum akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.course-sub-chapter.delete-video', $courseSubChapter->id) }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.message,
                                    });
                                }
                            },
                        });
                    }
                })
            }
        </script>
        <script>
            $(function() {
                $('#title').val('{{ $courseSubChapter->title }}');
                $('embed').attr('src',
                    '{{ $courseSubChapter->file ? asset('storage/course_sub_chapter/' . $courseSubChapter->file) : '' }}'
                );
                $('iframe').attr('src',
                    '{{ $courseSubChapter->video ? asset('storage/course_sub_chapter/' . $courseSubChapter->video) : '' }}'
                );
            });
        </script>
        <script>
            $(function() {
                $('#file').change(function() {
                    const file = $(this)[0].files[0];
                    const fileReader = new FileReader();
                    // if not pdf
                    if (file.type != 'application/pdf') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'File harus berupa pdf!',
                        });
                        $(this).val('');
                        return;
                    }
                    fileReader.onloadend = function() {
                        $('embed').attr('src', fileReader.result + '#toolbar=0');
                    }
                    fileReader.readAsDataURL(file);
                });

                $('button[type="submit"]').click(function(e) {
                    e.preventDefault();
                    let title = $('#title').val();
                    let file = $('#file').val();
                    let video = $('#video').val();

                    if (title == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Judul materi tidak boleh kosong!',
                        });
                        return;
                    }

                    // check file and video if empty in embed src and iframe src
                    if ($('embed').attr('src') == '' && $('#file').val() == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Isi salah satu tipe materi!',
                        });
                        return;
                    }

                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('title', title == '' ? null : title);
                    file != 'undefined' ? formData.append('file', $('#file')[0].files[0]) : '';
                    video != 'undefined' ? formData.append('video', $('#video')[0].files[0]) : '';

                    let url =
                        "{{ route('admin.course-sub-chapter.update', [$courseSubChapter->courseChapter->id, $courseSubChapter->id]) }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            if (data.status == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            '{{ route('admin.course-sub-chapter.index', $courseSubChapter->courseChapter->id) }}';
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message,
                                });
                            }
                        },
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
