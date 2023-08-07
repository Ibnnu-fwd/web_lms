<x-app-layout>
    <x-breadcrumb name="course.create" />

    <div class="xl:grid grid-cols-2 gap-8 space-y-6 md:space-y-0">
        <x-card-container class="">
            <h2 class="font-medium text-md mb-6">
                Informasi Kursus
            </h2>

            <x-input id="title" name="title" type="text" label="Kode Kelas" required />
            <x-input id="title" name="title" type="text" label="Nama Kelas" required />

            <x-textarea id="short_description" name="short_description" label="Deskripsi Singkat" required />
            <x-textarea id="description" name="description" label="Deskripsi Lengkap" required />
            <x-input id="price" name="price" type="number" label="Harga" required />
            <div class="md:grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-4 mt-4">
                <x-input-file id="main_image" name="main_image" label="Gambar Utama" required />
                <x-input-file id="sneek_peek_1" name="sneek_peek_1" label="Sneek Peek 1" required />
                <x-input-file id="sneek_peek_2" name="sneek_peek_2" label="Sneek Peek 2" required />
                <x-input-file id="sneek_peek_3" name="sneek_peek_3" label="Sneek Peek 3" required />
                <x-input-file id="sneek_peek_4" name="sneek_peek_4" label="Sneek Peek 4" required />
            </div>
            <div class="block md:flex justify-between items-center mt-4">
                <label for="" class="text-xs 2xl:text-sm">
                    Teknologi yang digunakan
                    <span class="text-red-500">*</span>
                </label>
                <button type="button" onclick="addTechnology()"
                    class="bg-dark text-white text-xs 2xl:text-sm py-2 px-4 rounded w-full md:w-fit mt-4 md:mt-0">
                    Tambah Teknologi </button>
            </div>
            <div id="technology-container" class="block md:grid xl:grid-cols-2 gap-4 mt-4">
            </div>
        </x-card-container>
        <x-card-container>
            <h2 class="font-medium text-md mb-6">
                Informasi Benefit
            </h2>

            <div class="md:grid grid-cols-2 gap-x-8">
                <div>
                    <x-input id="title_1" name="title_1" type="text" label="Benefit 1" required />
                    <x-textarea id="description_1" name="description_1" label="Deskripsi Benefit 1" required />
                </div>
                <div>
                    <x-input id="title_2" name="title_2" type="text" label="Benefit 2" required />
                    <x-textarea id="description_2" name="description_2" label="Deskripsi Benefit 2" required />
                </div>
                <div>
                    <x-input id="title_3" name="title_3" type="text" label="Benefit 3" required />
                    <x-textarea id="description_3" name="description_3" label="Deskripsi Benefit 3" required />
                </div>
                <div>
                    <x-input id="title_4" name="title_4" type="text" label="Benefit 4" required />
                    <x-textarea id="description_4" name="description_4" label="Deskripsi Benefit 4" required />
                </div>
            </div>

            <div class="block md:flex justify-between items-center mt-4">
                <h2 class="font-medium text-xs 2xl:text-sm">
                    Tujuan Pembelajaran
                </h2>
                <button type="button" onclick="addObjective()"
                    class="bg-dark text-white py-2 px-4 text-xs 2xl:text-sm rounded w-full md:w-fit mt-4 md:mt-0">
                    Tambah Tujuan </button>
            </div>
            <div id="objective-container" class="block md:grid grid-cols-2 gap-4 mt-4">
            </div>
        </x-card-container>
        <div>
            <x-button title="Tambah Kursus" class="w-full 2xl:w-fit mt-4 2xl:mt-0" />
        </div>
    </div>

    @push('js-internal')
        <!-- Ckeditor -->
        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

        <script>
            function removeObjective(id) {
                $(`#objective-${id}`).remove();
                $('#objective-container').children().each(function(index) {
                    $(this).find('label').text(`Tujuan Pembelajaran ${index + 1}`);
                });
            }

            function addObjective() {
                let id = Math.floor(Math.random() * 1000000);
                let count = $('#objective-container').children().length;
                let html = `
                    <div id="objective-${id}" class="mb-4 mt-2">
                        <x-input id="title-${id}" name="title-${id}" type="text" label="Tujuan Pembelajaran ${count + 1}" required />
                        <x-textarea id="description-${id}" name="description-${id}" label="Deskripsi Tujuan Pembelajaran" required />
                        <button type="button" onclick="removeObjective(${id})" class="bg-gray-500 text-white text-xs 2xl:text-sm py-2 px-4 rounded-md mt-3">
                            Hapus
                        </button>
                    </div>
                `;
                $('#objective-container').append(html);
            }

            function removeTechnology(id) {
                $(`#technology-${id}`).remove();
                $('#technology-container').children().each(function(index) {
                    $(this).find('label').text(`Teknologi ${index + 1}`);
                });
            }

            function addTechnology() {
                let id = Math.floor(Math.random() * 1000000);
                let count = $('#technology-container').children().length;
                let html = `
                    <div id="technology-${id}" class="mb-4 mt-2">
                        <label for="" class="mb-4 text-xs 2xl:text-sm">Teknologi ` + (count + 1) + `</label>
                        <div class="flex justify-between items-center mt-2">
                            <input type="text" name="technologies[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" placeholder="Teknologi" required>
                            <button type="button" onclick="removeTechnology(${id})" class="bg-gray-500 text-white py-2 px-4 rounded-md ml-3 text-xs 2xl:text-sm">
                                Hapus
                            </button>
                        </div>
                    </div>
                `;
                $('#technology-container').append(html);
            }

            function removeImage(id) {
                $(`.image-container-${id}`).removeClass('hidden');
                $(`.preview-image-${id}`).addClass('hidden');
                $(`#${id}`).val('');
            }

            $(function() {
                // CKEDITOR.on('instanceReady', function(ev) {
                //     ev.editor.resize('100%', '100px');
                // });

                // CKEDITOR.replace('short_description');
                // CKEDITOR.replace('description');

                $('#main_image').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-main_image').addClass('hidden');
                        $('.preview-image-main_image').removeClass('hidden');
                        $('.preview-image-main_image img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('#sneek_peek_1').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-sneek_peek_1').addClass('hidden');
                        $('.preview-image-sneek_peek_1').removeClass('hidden');
                        $('.preview-image-sneek_peek_1 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('#sneek_peek_2').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-sneek_peek_2').addClass('hidden');
                        $('.preview-image-sneek_peek_2').removeClass('hidden');
                        $('.preview-image-sneek_peek_2 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('#sneek_peek_3').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-sneek_peek_3').addClass('hidden');
                        $('.preview-image-sneek_peek_3').removeClass('hidden');
                        $('.preview-image-sneek_peek_3 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('#sneek_peek_4').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-sneek_peek_4').addClass('hidden');
                        $('.preview-image-sneek_peek_4').removeClass('hidden');
                        $('.preview-image-sneek_peek_4 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('button[type=submit]').click(function(e) {
                    e.preventDefault();

                    let title = $('#title').val();
                    let category_id = $('#category_id').val();
                    let short_description = $('#short_description').val();
                    let description = $('#description').val();
                    let price = $('#price').val();
                    let main_image = $('#main_image').val();
                    let sneek_peek_1 = $('#sneek_peek_1').val();
                    let sneek_peek_2 = $('#sneek_peek_2').val();
                    let sneek_peek_3 = $('#sneek_peek_3').val();
                    let sneek_peek_4 = $('#sneek_peek_4').val();
                    let technologies = $('input[name="technologies[]"]').map(function() {
                        return $(this).val();
                    }).get();
                    let benefit = [];
                    // add benefit to array
                    benefit.push({
                        title: $('#title_1').val(),
                        description: $('#description_1').val()
                    });
                    benefit.push({
                        title: $('#title_2').val(),
                        description: $('#description_2').val()
                    });
                    benefit.push({
                        title: $('#title_3').val(),
                        description: $('#description_3').val()
                    });
                    benefit.push({
                        title: $('#title_4').val(),
                        description: $('#description_4').val()
                    });

                    let objectives = [];
                    // add objective to array
                    $('input[name^="title-"]').each(function(index) {
                        objectives.push({
                            title: $(this).val(),
                            description: $(`#description-${$(this).attr('id').split('-')[1]}`)
                                .val()
                        });
                    });



                    console.log(title, category_id, short_description,
                        description, price, main_image,
                        sneek_peek_1, sneek_peek_2, sneek_peek_3, sneek_peek_4, technologies, benefit,
                        objectives);

                    // check if all required fields are filled
                    if (title && category_id && short_description && description && price && main_image &&
                        sneek_peek_1 && sneek_peek_2 && sneek_peek_3 && sneek_peek_4 && technologies.length &&
                        benefit.length && objectives.length) {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('title', title);
                        formData.append('category_id', category_id);
                        formData.append('short_description', short_description);
                        formData.append('description', description);
                        formData.append('price', price);
                        formData.append('main_image', $('#main_image')[0].files[0]);
                        formData.append('sneek_peek_1', $('#sneek_peek_1')[0].files[0]);
                        formData.append('sneek_peek_2', $('#sneek_peek_2')[0].files[0]);
                        formData.append('sneek_peek_3', $('#sneek_peek_3')[0].files[0]);
                        formData.append('sneek_peek_4', $('#sneek_peek_4')[0].files[0]);
                        technologies.forEach(function(technology) {
                            formData.append('technologies[]', technology);
                        });
                        benefit.forEach(function(benefit) {
                            formData.append('benefits[]', JSON.stringify(benefit));
                        });
                        objectives.forEach(function(objective) {
                            formData.append('objectives[]', JSON.stringify(objective));
                        });

                        $.ajax({
                            url: "{{ route('admin.course.store') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Mohon tunggu sebentar!',
                                    html: 'Sedang menambahkan kursus...',
                                    didOpen: () => {
                                        Swal.showLoading()
                                    },
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                });
                            },
                            success: function(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                        showConfirmButton: true,
                                    }).then(function() {
                                        window.location.href =
                                            "{{ route('admin.course.index') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                }
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Periksa kembali semua field wajib diisi!',
                        });
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
