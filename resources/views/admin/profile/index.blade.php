<x-app-layout>
    <x-breadcrumb name="profile" />
    <x-card-container class="w-full xl:w-1/2 2xl:w-1/3 md:grid grid-cols-3 gap-4">
        <div>
            <img src="{{ auth()->user()->avatar ? asset('storage/avatar/' . auth()->user()->avatar) : asset('images/no_image.jpg') }}"
                alt="" class="w-full h-36 object-cover rounded-md object-center" id="avatarContainer">
            <input name="avatar" type="file" id="avatar" class="hidden">
            <x-button type="button" title="Ganti Foto" class="w-full mt-4" color="dark" colorHover="black"
                onclick="changeImage()" />
        </div>

        <form class="col-span-2 mt-4 md:mt-0" action="{{ route('admin.profile.update', auth()->user()->id) }}"
            method="POST">
            @csrf
            <x-input id="fullname" label="Nama lengkap" name="fullname" type="text"
                value="{{ auth()->user()->fullname }}" required />
            <x-select id="gender" title="Gender" name="gender" class="w-full" required>
                <option value="L">Laki Laki</option>
                <option value="P">Perempuan</option>
            </x-select>
            <x-input id="birthday" label="Tanggal Lahir" name="birthday" type="text" required
                value="{{ auth()->user()->birthday }}" />
            <x-input id="phone" label="No Telephone" name="phone" type="text" required
                value="{{ auth()->user()->phone }}" />
            <x-input id="job" label="Pekerjaan" name="job" type="text" value="{{ auth()->user()->job }}"
                required />
            <x-input id="institution" label="Institusi" name="institution" type="text" required
                value="{{ auth()->user()->institution }}" />
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>

    @push('js-internal')
        <script>
            function changeImage() {
                $('input[name="avatar"]').click()

                $('input[name="avatar"]').change(function() {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#avatarContainer').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }

                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Apakah anda yakin ingin mengubah foto?',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('avatar', $('input[name="avatar"]')[0].files[0]);

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.profile.change-image') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                    }).then((result) => {
                                        location.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message,
                                    })
                                }
                            }
                        });
                    })
                })
            }

            $(function() {
                $("#birthday").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd',
                });
            });
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
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
