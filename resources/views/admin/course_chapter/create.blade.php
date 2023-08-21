<x-app-layout>
    <x-breadcrumb name="course_chapter.create" :data="$course" />
    <x-card-container class="w-full">
        <form action="{{ route('admin.course-chapter.store', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input id="title" name="title" label="Judul" type="text" required />
            <x-textarea id="description" name="description" label="Deskripsi" required />
            <x-input id="pdf_file" name="pdf_file" type="file" label="File Materi Teori (pdf)"
                accept="application/pdf" />
            <x-input id="video_file" name="video_file" type="file" label="File Materi Praktikum (mp4, max. 1 MB)"
                accept="video/*" />
<<<<<<< Updated upstream
            <x-input id="scrom_file" name="scrom_file" type="file" label="File Latih (zip)" accept="application/zip" />
=======
            <x-input id="scrom_file" name="scrom_file" type="file" label="File Latih" accept="application/zip" /> 
>>>>>>> Stashed changes
            <x-button title="Tambah Materi" />
        </form>
    </x-card-container>

    <div class="md:grid grid-cols-2 mt-8 gap-4">
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Teori
                </h2>
            </div>
            <embed id="pdf_preview" src="" class="w-full rounded-lg">
        </div>
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Praktikum
                </h2>
            </div>
            <iframe src="" frameborder="0" id="video_preview" class="w-full rounded-lg"></iframe>
        </div>
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview SCROM
                </h2>
            </div>
            <iframe src="" frameborder="0" id="scrom_preview" class="w-full rounded-lg"></iframe>
<<<<<<< Updated upstream
        </div> 
=======
        </div>
>>>>>>> Stashed changes
    </div>

    @push('js-internal')
        <script>
            $(function() {
                // Function to update the PDF preview
                function updatePdfPreview(url) {
                    $('#pdf_preview').attr('src', url);
                }

                // Function to update the video preview
                function updateVideoPreview(url) {
                    $('#video_preview').attr('src', url);
                }

                // Function to update the SCORM preview
                function updateScromPreview(url) {
                    $('#scrom_preview').attr('src', url);
                }

                // Event listener for the PDF file input change
                $('#pdf_file').on('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var url = URL.createObjectURL(file);
                        updatePdfPreview(url);
                    }
                });

                // Event listener for the video file input change
                $('#video_file').on('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var url = URL.createObjectURL(file);
                        updateVideoPreview(url);
                    }
                });

                Event listener for the SCORM file input change
                $('#scrom_file').on('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var url = URL.createObjectURL(file);
                        updateScromPreview(url);
                    }
                });

                $('button[type="submit"]').on('click', function() {
                    const pdfFile = $('#pdf_file')[0].files[0];
                    const videoFile = $('#video_file')[0].files[0];

                    // Check if at least pdf or video file is uploaded
                    if (!pdfFile && !videoFile) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Harus mengunggah file materi teori atau materi praktikum',
                        });
                        return false;
                    }

                    const maxSize = 100000000; // 100 MB

                    // Function to display error alert
                    function showErrorAlert(title, text) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: text,
                        });
                        return false;
                    }

                    // Function to validate file type and size
                    function validateFile(file, allowedType, maxSize, errorMessage) {
                        if (file) {
                            if (file.size > maxSize) {
                                return showErrorAlert('Gagal', errorMessage);
                            }

                            if (file.type !== allowedType) {
                                return showErrorAlert('Gagal', errorMessage);
                            }
                        }
                        return true;
                    }

                    // Validate PDF file
                    if (!validateFile(pdfFile, 'application/pdf', maxSize,
                            'Ukuran file PDF maksimal 10 MB dan harus berformat PDF')) {
                        return false;
                    }

                    // Validate video file
                    if (!validateFile(videoFile, 'video/mp4', maxSize,
                            'Ukuran file video maksimal 100 MB dan harus berformat MP4')) {
                        return false;
                    }

                    // Validate SCROM file
                    if (!validateFile(scromFile, 'application/zip', maxSize,
                            'Ukuran file SCROM maksimal 100 MB dan harus berformat ZIP')) {
                        return false;
                    }

                    return true;
                });

            });

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = '{{ route('admin.course-chapter.index', $course->id) }}';
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
</x-app-layout>
