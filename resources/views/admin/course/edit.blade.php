<x-app-layout>
    <x-breadcrumb name="course.edit" :data="$course" />
    <x-card-container class="w-full">
        <div class="justify-start text-left">

            <div x-data="{ tab: 'tab1' }">
                <ul class="flex gap-3 text-sm text-black border-b">
                    <li class="-mb-px">
                        <!-- event handler set state to 'tab1' and add conditional :class for active state -->
                        <a @click.prevent="tab = 'tab1'" href="#" class="inline-block py-2 text-xs 2xl:text-sm"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab1' }">
                            Informasi Produk
                        </a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab2'" href="#" class="inline-block py-2 text-xs 2xl:text-sm"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab2' }">
                            Gambar
                        </a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab3'" href="#"
                            class="inline-block py-2 text-xs 2xl:text-sm bg-white text-blue-500 border-b-2 border-blue-500"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab3' }">
                            Teknologi
                        </a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab4'" href="#"
                            class="inline-block py-2 text-xs 2xl:text-sm bg-white text-blue-500 border-b-2 border-blue-500"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab4' }">
                            Benefit
                        </a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab5'" href="#"
                            class="inline-block py-2 text-xs 2xl:text-sm bg-white text-blue-500 border-b-2 border-blue-500"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab5' }">
                            Tujuan
                        </a>
                    </li>
                    <li class="-mb-px">
                        <a @click.prevent="tab = 'tab6'" href="#"
                            class="inline-block py-2 text-xs 2xl:text-sm bg-white text-blue-500 border-b-2 border-blue-500"
                            :class="{ ' bg-white text-blue-500 border-b-2 border-blue-500': tab === 'tab6' }">
                            Diskon
                        </a>
                    </li>
                </ul>
                <div class="py-4 pt-4 text-left bg-white content">
                    <!-- show tab1 only -->
                    <div x-show="tab==='tab1'" class="text-gray-500" style="display: none;">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <x-input id="title" name="title" type="text" label="Judul" required />
                                <x-select id="category_id" title="Kategori" name="category_id" required class="w-full">
                                    @foreach ($courseCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-textarea id="short_description" name="short_description" label="Deskripsi Singkat"
                                    required />
                                <x-textarea id="description" name="description" label="Deskripsi Lengkap" required />
                                <x-input id="price" name="price" type="number" label="Harga" required />
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab2'" class="text-gray-500" style="display: none;">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <div class="md:grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-5 gap-x-4 mt-4">
                                    <x-input-file id="main_image" name="main_image" label="Gambar Utama" required />
                                    <x-input-file id="sneek_peek_1" name="sneek_peek_1" label="Sneek Peek 1" required />
                                    <x-input-file id="sneek_peek_2" name="sneek_peek_2" label="Sneek Peek 2" required />
                                    <x-input-file id="sneek_peek_3" name="sneek_peek_3" label="Sneek Peek 3" required />
                                    <x-input-file id="sneek_peek_4" name="sneek_peek_4" label="Sneek Peek 4" required />
                                </div>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab3'" class="text-gray-500">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <button type="button" onclick="addTechnology()"
                                    class="bg-dark text-white text-xs 2xl:text-sm py-2 px-4 rounded w-full md:w-fit mt-4 md:mt-0">
                                    Tambah Teknologi </button>
                                <div id="technology-container" class="block md:grid xl:grid-cols-4 gap-4 mt-4">
                                </div>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab4'" class="text-gray-500">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <div class="">
                                    <div>
                                        <x-input id="title_1" name="title_1" type="text" label="Benefit 1"
                                            required />
                                        <x-textarea id="description_1" name="description_1" label="Deskripsi Benefit 1"
                                            required />
                                    </div>
                                    <hr class="my-3">
                                    <div>
                                        <x-input id="title_2" name="title_2" type="text" label="Benefit 2"
                                            required />
                                        <x-textarea id="description_2" name="description_2" label="Deskripsi Benefit 2"
                                            required />
                                    </div>
                                    <hr class="my-3">
                                    <div>
                                        <x-input id="title_3" name="title_3" type="text" label="Benefit 3"
                                            required />
                                        <x-textarea id="description_3" name="description_3"
                                            label="Deskripsi Benefit 3" required />
                                    </div>
                                    <hr class="my-3">
                                    <div>
                                        <x-input id="title_4" name="title_4" type="text" label="Benefit 4"
                                            required />
                                        <x-textarea id="description_4" name="description_4"
                                            label="Deskripsi Benefit 4" required />
                                    </div>
                                </div>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab5'" class="text-gray-500">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <div class="block md:flex justify-between items-center mt-4">
                                    <button type="button" onclick="addObjective()"
                                        class="bg-dark text-white py-2 px-4 text-xs 2xl:text-sm rounded w-full md:w-fit mt-4 md:mt-0">
                                        Tambah Tujuan </button>
                                </div>
                                <div id="objective-container" class="mt-4">
                                </div>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                    <div x-show="tab==='tab6'" class="text-gray-500">
                        <main>
                            <!-- === Remove and replace with your own content... === -->
                            <div class="py-4">
                                <div class="text-end">
                                    <x-link-button title="Tambah" onclick="addDiscount()" />
                                </div>
                                <table id="discountTable" class="w-ful">
                                    <thead>
                                        <tr>
                                            <th>Grup</th>
                                            <th>Harga</th>
                                            <th>Tgl. Mulai</th>
                                            <th>Tgl. Berakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($courseDiscount))
                                            @foreach ($courseDiscount as $data)
                                                <tr>
                                                    <td>
                                                        <select name="discount_group[]"
                                                            class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                            required>
                                                            <option value="">Pilih</option>
                                                            <option value="2"
                                                                {{ $data['role'] == 2 ? 'selected' : '' }}>Insitusi
                                                            </option>
                                                            <option value="3"
                                                                {{ $data['role'] == 3 ? 'selected' : '' }}>Personal
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="discount[]"
                                                            class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                            placeholder="Potongan Harga" required
                                                            value="{{ $data['discount_price'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="start_date[]"
                                                            class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                            placeholder="Tanggal Mulai" required
                                                            value="{{ $data['start_date'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="end_date[]"
                                                            class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                            placeholder="Tanggal Berakhir" required
                                                            value="{{ $data['end_date'] }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" onclick="removeDiscount()"
                                                            class="bg-gray-500 text-white text-xs 2xl:text-sm py-2 px-4 rounded-md">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <select name="discount_group[]"
                                                        class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                        required>
                                                        <option value="">Pilih</option>
                                                        <option value="2">Insitusi</option>
                                                        <option value="3">Personal</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="discount[]"
                                                        class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                        placeholder="Potongan Harga" required>
                                                </td>
                                                <td>
                                                    <input type="date" name="start_date[]"
                                                        class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                        placeholder="Tanggal Mulai" required>
                                                </td>
                                                <td>
                                                    <input type="date" name="end_date[]"
                                                        class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm"
                                                        placeholder="Tanggal Berakhir" required>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="removeDiscount()"
                                                        class="bg-gray-500 text-white text-xs 2xl:text-sm py-2 px-4 rounded-md">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- === End ===  -->
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </x-card-container>

    <x-button title="Simpan Perubahan" class="mt-4 2xl:mt-4" />



    @push('js-internal')
        <script>
            let discount = [];

            function addDiscount() {
                // get all discount
                $('select[name^="discount_group"]').each(function(index) {
                    discount.push({
                        role: $(this).val(),
                        discount_price: $(`input[name="discount[]"]`).eq(index).val(),
                        start_date: $(`input[name="start_date[]"]`).eq(index).val(),
                        end_date: $(`input[name="end_date[]"]`).eq(index).val(),
                    });
                });

                // add input field
                let html = `
                    <tr>
                        <td>
                            <select name="discount_group[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" required>
                                <option value="">Pilih</option>
                                <option value="2">Insitusi</option>
                                <option value="3">Personal</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="discount[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" placeholder="Potongan Harga" required>
                        </td>
                        <td>
                            <input type="date" name="start_date[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" placeholder="Tanggal Mulai" required>
                        </td>
                        <td>
                            <input type="date" name="end_date[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" placeholder="Tanggal Berakhir" required>
                        </td>
                        <td>
                            <button type="button" onclick="removeDiscount()" class="bg-gray-500 text-white text-xs 2xl:text-sm py-2 px-4 rounded-md">
                                Hapus
                            </button>
                        </td>
                    </tr>
                `;

                $("#discountTable tbody").append(html);
            }

            // check if user select same role
            $(document).on('change', 'select[name^="discount_group"]', function() {
                let role = $(this).val();
                let index = $('select[name^="discount_group"]').index(this);

                // check if user select same role
                $('select[name^="discount_group"]').each(function(i) {
                    if (i != index) {
                        if ($(this).val() == role) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Anda tidak dapat memilih role yang sama!',
                            });
                            // remove row
                            $('select[name^="discount_group"]').eq(index).val('');
                            return false;
                        }
                    }
                });
            });

            function removeDiscount() {
                // remove this row
                $(event.target).closest('tr').remove();
            }

            // get start date & end date discount, then check if end date is less than start date
            $(document).on('change', 'input[name^="start_date"], input[name^="end_date"]', function() {
                let startDate = $(this).closest('tr').find('input[name^="start_date"]').val();
                let endDate = $(this).closest('tr').find('input[name^="end_date"]').val();

                if (startDate && endDate) {
                    if (endDate < startDate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tanggal berakhir tidak boleh kurang dari tanggal mulai!',
                        });
                        $(this).val('');
                    }
                }
            });

            $(function() {
                $('#discountTable').DataTable({
                    // hide search & show entries
                    searching: false,
                    lengthChange: false,
                    autoWidth: false,
                });
            })
        </script>

        <script>
            $('#title').val('{{ $course->title }}');
            $('#category_id').append(
                `<option value="{{ $course->category_id }}" selected>{{ $course->category->name }}</option>`);
            $('#price').val('{{ $course->price }}');
            $('#short_description').val(`{!! $course->short_description !!}`);
            $('#description').val(`{!! $course->description !!}`);
            $('#title_1').val('{{ $course->courseBenefit[0]->title }}');
            $('#description_1').val('{{ $course->courseBenefit[0]->description }}');
            $('#title_2').val('{{ $course->courseBenefit[1]->title }}');
            $('#description_2').val('{{ $course->courseBenefit[1]->description }}');
            $('#title_3').val('{{ $course->courseBenefit[2]->title }}');
            $('#description_3').val('{{ $course->courseBenefit[2]->description }}');
            $('#title_4').val('{{ $course->courseBenefit[3]->title }}');
            $('#description_4').val('{{ $course->courseBenefit[3]->description }}');

            let objectives = @json($course->courseObjective);

            objectives.forEach(function(objective) {
                let id = Math.floor(Math.random() * 1000000);
                let html = `
                    <div id="objective-${id}" class="mb-4 mt-2">
                        <x-input id="title-${id}" name="title-${id}" type="text" label="Tujuan Pembelajaran ` + (
                    objectives.indexOf(objective) + 1) + `" required value="${objective.title}" />
                        <x-textarea id="description-${id}" name="description-${id}" label="Deskripsi Tujuan Pembelajaran" required>${objective.description}</x-textarea>
                        <button type="button" onclick="removeObjective(${id})" class="bg-gray-500 text-white text-xs 2xl:text-sm py-2 px-4 rounded-md mt-3">
                            Hapus
                        </button>
                    </div>
                `;
                $('#objective-container').append(html);
            });
            let technologies = @json($course->courseTechSpec);
            technologies.forEach(function(technology) {
                let id = Math.floor(Math.random() * 1000000);
                let html = `
                    <div id="technology-${id}" class="mb-4 mt-2">
                        <label for="" class="mb-4 text-xs 2xl:text-sm">Teknologi ` + (technologies.indexOf(
                    technology) + 1) + `</label>
                        <div class="flex justify-between items-center mt-2">
                            <input type="text" name="technologies[]" class="form-input rounded-md shadow-sm block w-full text-xs 2xl:text-sm" placeholder="Teknologi" required value="${technology.name}">
                            <button type="button" onclick="removeTechnology(${id})" class="text-xs 2xl:text-sm bg-gray-500 text-white py-2 px-4 rounded-md ml-3">
                                Hapus
                            </button>
                        </div>
                    </div>
                `;
                $('#technology-container').append(html);
            });

            @if ($course->main_image)
                $('.image-container-main_image').addClass('hidden');
                $('.preview-image-main_image').removeClass('hidden');
                $('.preview-image-main_image img').attr('src', '{{ asset('storage/courses/' . $course->main_image) }}');
            @endif

            @if ($course->sneek_peek_1)
                $('.image-container-sneek_peek_1').addClass('hidden');
                $('.preview-image-sneek_peek_1').removeClass('hidden');
                $('.preview-image-sneek_peek_1 img').attr('src',
                    '{{ asset('storage/sneek_peeks/' . $course->sneek_peek_1) }}');
            @endif

            @if ($course->sneek_peek_2)
                $('.image-container-sneek_peek_2').addClass('hidden');
                $('.preview-image-sneek_peek_2').removeClass('hidden');
                $('.preview-image-sneek_peek_2 img').attr('src',
                    '{{ asset('storage/sneek_peeks/' . $course->sneek_peek_2) }}');
            @endif

            @if ($course->sneek_peek_3)
                $('.image-container-sneek_peek_3').addClass('hidden');
                $('.preview-image-sneek_peek_3').removeClass('hidden');
                $('.preview-image-sneek_peek_3 img').attr('src',
                    '{{ asset('storage/sneek_peeks/' . $course->sneek_peek_3) }}');
            @endif

            @if ($course->sneek_peek_4)
                $('.image-container-sneek_peek_4').addClass('hidden');
                $('.preview-image-sneek_peek_4').removeClass('hidden');
                $('.preview-image-sneek_peek_4 img').attr('src',
                    '{{ asset('storage/sneek_peeks/' . $course->sneek_peek_4) }}');
            @endif
        </script>
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
                        <button type="button" onclick="removeObjective(${id})" class="bg-gray-500 text-white py-2 px-4 rounded-md mt-3">
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
                        <label for="" class="mb-4">Teknologi ` + (count + 1) + `</label>
                        <div class="flex justify-between items-center mt-2">
                            <input type="text" name="technologies[]" class="form-input rounded-md shadow-sm block w-full" placeholder="Teknologi" required>
                            <button type="button" onclick="removeTechnology(${id})" class="bg-gray-500 text-white py-2 px-4 rounded-md ml-3">
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


                    // get all discount
                    let discount = [];
                    $('select[name^="discount_group"]').each(function(index) {
                        discount.push({
                            role: $(this).val(),
                            discount_price: $(`input[name="discount[]"]`).eq(index).val(),
                            start_date: $(`input[name="start_date[]"]`).eq(index).val(),
                            end_date: $(`input[name="end_date[]"]`).eq(index).val(),
                        });
                    });

                    // check if there is empty value in discount
                    discount.forEach(function(discount) {
                        if (discount.role == '' || discount.discount_price == '' || discount
                            .start_date ==
                            '' || discount.end_date == '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Field diskon tidak boleh kosong!',
                            });

                            return false;
                        }
                    });

                    console.log(title, category_id, short_description,
                        description, price, main_image,
                        sneek_peek_1, sneek_peek_2, sneek_peek_3, sneek_peek_4, technologies, benefit,
                        objectives, discount);

                    // check if all required fields are filled
                    if (title && category_id && short_description && description && price && main_image &&
                        sneek_peek_1 && sneek_peek_2 && sneek_peek_3 && sneek_peek_4 && technologies.length &&
                        benefit.length, objectives.length) {
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
                        if (discount.length > 0) {
                            formData.append('discount', JSON.stringify(discount));
                        }

                        $.ajax({
                            url: "{{ route('admin.course.update', ':id') }}".replace(':id',
                                '{{ $course->id }}'),
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                console.log(response);
                                if (response.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                        showConfirmButton: true,
                                    }).then((result) => {
                                        location.reload();
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
