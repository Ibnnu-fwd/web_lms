<x-app-layout>
    <x-breadcrumb name="user-dashboard" />
    <div class="text-gray-500 md:grid xl:grid-cols-2 2xl:grid-cols-3 gap-4 space-y-5 md:space-y-0">
        @foreach ($detailTransaction as $data)
            <x-card-container>
                {{-- <ion-icon name="code-slash" size="large"></ion-icon> --}}
                <h1 class="text-lg font-medium text-gray-900">
                    {{ $data->course->title }}
                </h1>
                <div class="flex flex-row items-center gap-5 mt-2">
                    <div class="flex flex-row items-center gap-2 ">
                        <ion-icon name="time-outline" style="font-size:20px"></ion-icon>
                        <span class="text-sm font-light">
                            {{ $data->total_month }} (Bulan) |
                            {{ date('d-m-Y', strtotime($data->end_date)) }}
                        </span>
                    </div>
                    <div class="flex flex-row items-center gap-2 ">
                        <ion-icon name="book-outline" style="font-size:20px"></ion-icon>
                        <span class="text-sm font-light">
                            {{ $data->course->courseChapter->count() }} Materi </span>
                    </div>
                </div>
                <div class="w-full mt-4 bg-neutral-200 rounded-full">
                    <div class="bg-dark rounded-full text-white p-0.2 text-center text-xs font-medium leading-none text-primary-100"
                        style="width: {{ $data->course->progress }}%">
                        {{ $data->course->progress }}%
                    </div>
                </div>
                @if (!$data->isExpired)
                    <x-link-button title="Pelajari Sekarang" class="mt-6" color="dark"
                        route="{{ route('user.course.detail', [$data->course->id, $data->course->courseChapter->first()->id]) }}" />
                @else
                    <x-link-button title="Modul Kadaluarsa" class="mt-6 bg-gray-600" onclick="javascript:void(0)" />
                @endif
            </x-card-container>
        @endforeach
    </div>

    <script>
        @if (Session::has('finish'))
            Swal.fire({
                icon: 'finish',
                title: 'Berhasil',
                text: '{{ Session::get('finish') }}',
                showConfirmButton: false,
            })
        @endif
    </script>
</x-app-layout>
