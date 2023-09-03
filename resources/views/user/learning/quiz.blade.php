<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    {{-- <link href="https://fonts.cdnfonts.com/css/rubik" rel="stylesheet"> --}}
    <link href="https://fonts.cdnfonts.com/css/lexend-deca" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

    <!-- Alert -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar"
        aria-controls="separator-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="separator-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <ul class="space-y-2 font-normal text-xs 2xl:text-sm">
                <li>
                    <p class="p-2 font-medium">
                        Daftar Materi
                    </p>
                </li>
                @foreach ($course->courseChapter as $chapter)
                    <li>
                        <a href="{{ $chapter->is_complete ? route('user.course.detail', [$course->id, $chapter->id]) : '#' }}"
                            class="flex items-center p-2 border text-gray-900 rounded-lg hover:bg-gray-100 group">
                            <ion-icon name="{{ $chapter->is_complete ? 'checkmark-outline' : 'play-circle-outline' }}"
                                class="text-xl text-gray-500 group-hover:text-gray-900"></ion-icon>
                            <span class="ml-3">
                                {{ $chapter->title }}
                            </span>
                        </a>
                    </li>

                    @if ($chapter->quiz)
                        <li>
                            <a href="{{ $chapter->quiz->is_complete ? route('user.course.quiz', $chapter->quiz->id) : '#' }}"
                                class="flex items-center p-2 border text-gray-900 rounded-lg hover:bg-gray-100 group">
                                <ion-icon
                                    name="{{ $chapter->quiz->is_complete ? 'checkmark-outline' : 'play-circle-outline' }}"
                                    class="text-xl text-gray-500 group-hover:text-gray-900"></ion-icon>
                                <span class="ml-3">
                                    {{ $chapter->quiz->title }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endforeach
                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center p-2 border mt-4 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <ion-icon name="log-out-outline" class="text-xl text-gray-500 group-hover:text-gray-900">
                        </ion-icon>
                        <span class="ml-3">
                            Keluar
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 max-w-5xl mx-auto border border-dashed">
            @foreach ($quiz->questions as $key => $question)
                <div class="mb-8 question-container question-{{ $key + 1 }}">
                    <div class="flex justify-between">
                        <h1 class="text-md font-medium text-gray-900">
                            {{ $question->question }}
                        </h1>
                        <p class="text-gray-500">
                            ({{ $key + 1 }})
                        </p>
                    </div>
                    <br>

                    <div class="space-y-4 mb-6">
                        @foreach (['a', 'b', 'c', 'd'] as $option)
                            @if ($question->{"option_$option"})
                                <div class="flex items-center pl-4 border border-gray-200 rounded">
                                    <input id="option_{{ $option }}_{{ $question->id }}" type="radio"
                                        name="option_{{ $question->id }}" value="{{ $option }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="option_{{ $option }}_{{ $question->id }}"
                                        class="w-full py-4 ml-2 text-sm text-gray-900">
                                        {{ $question->{"option_$option"} }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            <x-button type="button" id="sendQuiz" title="Kirim" />
        </div>
    </div>

    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

    <script>
        $('#sendQuiz').click(function(e) {
            e.preventDefault();
            let results = [];
            let errorMessages = [];

            @foreach ($quiz->questions as $key => $question)
                let option_{{ $question->id }} = $('input[name="option_{{ $question->id }}"]:checked')
                    .val();

                if (typeof option_{{ $question->id }} === 'undefined') {
                    errorMessages.push("Pertanyaan {{ $question->id }} belum dipilih!");
                } else {
                    // Ubah nilai "on" menjadi "a", "b", "c", atau "d"
                    switch (option_{{ $question->id }}) {
                        case 'a':
                            option_{{ $question->id }} = 'a';
                            break;
                        case 'b':
                            option_{{ $question->id }} = 'b';
                            break;
                        case 'c':
                            option_{{ $question->id }} = 'c';
                            break;
                        case 'd':
                            option_{{ $question->id }} = 'd';
                            break;
                        default:
                            // Penanganan jika nilai tidak valid
                            errorMessages.push(
                                "Pertanyaan {{ $question->id }} memiliki nilai tidak valid: " +
                                option_{{ $question->id }});
                    }
                }

                results.push({
                    question_id: {{ $question->id }},
                    option: option_{{ $question->id }}
                });
            @endforeach

            if (errorMessages.length > 0) {
                // Tampilkan SweetAlert error dengan pesan-pesan kesalahan
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorMessages.join("\n"),
                });
            } else {
                // Tidak ada kesalahan, tampilkan hasil di console
                console.log(results);

                Swal.fire({
                    icon: 'question',
                    title: 'Apakah Anda yakin?',
                    text: 'Kita akan mengirim jawaban Anda!',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    $.ajax({
                        url: "{{ route('user.course.quiz.finish', ':id') }}".replace(':id',
                            {{ $quiz->id }}),
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            answer: results
                        },
                        success: function(response) {
                            if (response.status == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                });

                                setTimeout(function() {
                                    window.location.href = `${response.next}`;
                                }, 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        },
                    });
                })
            }
        });
    </script>
</body>

</html>
