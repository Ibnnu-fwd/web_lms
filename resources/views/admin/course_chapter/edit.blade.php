<x-app-layout>
    <x-breadcrumb name="course_chapter.edit" :data="$course_chapter" />
    <x-card-container class="w-full">
        <form action="{{ route('admin.course-chapter.update', [$course_id, $course_chapter->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="title" name="title" label="Judul" type="text" :value="$course_chapter->title" required />
            <x-textarea id="description" name="description" label="Deskripsi"
                required>{{ $course_chapter->description }}</x-textarea>
            <x-input id="pdf_file" name="pdf_file" type="file" label="File Materi Teori (pdf)"
                accept="application/pdf" />
            <x-input id="video_file" name="video_file" type="file" label="File Materi Praktikum (mp4, max. 1 MB)"
                accept="video/*" />
            <x-input id="scrom_file" name="scrom_file" type="file" label="File Latih" accept="application/zip" />
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>

    <div class="md:grid grid-cols-2 mt-8 gap-4">
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Teori
                </h2>
            </div>
            {{-- fullscreen button --}}
            <div class="flex justify-end mb-4">
                <button id="fullscreen" class="bg-gray-700 hover:bg-gray-600 text-white rounded-lg px-4 py-2">
                    Fullscreen
                </button>
            </div>
            <embed id="pdf_preview" src="" class="w-full rounded-lg" style="height: 400px">
        </div>
        <div class="border-gray-200 border-2 border-dashed rounded-lg p-4">
            <div class="md:flex justify-between items-center mb-6">
                <h2 class="text-xs 2xl:text-sm font-medium">
                    Preview Materi Praktikum
                </h2>
            </div>
            <iframe src="" frameborder="0" id="video_preview" class="w-full rounded-lg"
                style="height: 400px"></iframe>
        </div>
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
                // function updateScromPreview(url) {
                //     $('#scrom_preview').attr('src', url);
                // }

                // Update the PDF preview when the PDF file input changes
                $('#pdf_file').change(function() {
                    updatePdfPreview(URL.createObjectURL(this.files[0]));
                });

                // Update the video preview when the video file input changes
                $('#video_file').change(function() {
                    updateVideoPreview(URL.createObjectURL(this.files[0]));
                });

                // Update the SCORM preview when the SCORM file input changes
                // $('#scrom_file').change(function () {
                //     updateScromPreview(URL.createObjectURL(this.files[0]));
                // });

                // Update the PDF preview when the page loads
                updatePdfPreview('{{ asset('storage/course/chapter/pdf/' . $course_chapter->pdf_file) }}');

                // Update the video preview when the page loads
                updateVideoPreview('{{ asset('storage/course/chapter/video/' . $course_chapter->video_file) }}');

                $('button[type="submit"]').click(function() {
                    // submit form and show loading form
                    $(this).parents('form').submit();
                    $(this).parents('form').find('button[type="submit"]').attr('disabled', true);
                    $(this).parents('form').find('button[type="submit"]').html(
                        'Menyimpan...');

                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                });
            });


            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = '{{ route('admin.course-chapter.index', $course_id) }}';
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
