<x-app-layout>
    <x-breadcrumb name="mincourse.edit" :data="$minCourse" />

    <div class="xl:grid grid-cols-2 gap-8 space-y-6 md:space-y-0">
        <x-card-container>
            <h2 class="font-semibold text-lg mb-6">
                Informasi MinCourse
            </h2>

            <x-input id="name" name="name" type="text" label="Nama" :value="$minCourse->name" required />
            <x-input id="value" name="value" type="text" label="Nilai" :value="$minCourse->value" required />
            <input type="hidden" name="id" value="{{ $minCourse->id }}">
            <x-button title="Simpan Perubahan" class="w-full 2xl:w-fit mt-4 2xl:mt-0" id="updateButton" />
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $('#name').val('{{ $minCourse->name }}');
            $('#value').val('{{ $minCourse->value }}');
            let id = '{{ $minCourse->id }}';

            $('#updateButton').click(function(e) {
                e.preventDefault();

                let name = $('#name').val();
                let value = $('#value').val();
                let id = $('input[name="id"]').val(); // Dapatkan ID MinCourse

                if (name && value) {
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('name', name);
                    formData.append('value', value);

                    $.ajax({
                        url: "{{ route('admin.mincourse.update', ':id') }}".replace(':id',
                            '{{ $minCourse->id }}'
                        ),
                        type: "PUT",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'MinCourse berhasil diperbarui!',
                            }).then(() => {
                                window.location.href = "{{ route('admin.mincourse.index') }}";
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat memperbarui MinCourse!',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Periksa kembali semua field wajib diisi!',
                    });
                }
            });
        </script>
    @endpush

</x-app-layout>
