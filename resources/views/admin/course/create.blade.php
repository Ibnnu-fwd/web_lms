<x-app-layout>
    @push('css-internal')
    @endpush

    <x-breadcrumb name="course.create" />

    <div class="md:grid grid-cols-2 gap-8">
        <x-card-container>
            <h2 class="font-semibold text-lg mb-6">
                Informasi Kursus
            </h2>

            <x-input id="title" name="title" type="text" label="Judul" required />
            <x-select id="category_id" title="Kategori" name="category_id" required>
                @foreach ($courseCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>

            <x-textarea id="short_description" name="short_description" label="Deskripsi Singkat" required />
            <x-textarea id="description" name="description" label="Deskripsi Lengkap" required />
            <div class="md:grid grid-cols-5">
                <x-input-file id="main_image" name="main_image" label="Gambar Utama" required />
            </div>
        </x-card-container>
        <x-card-container>
            <h2 class="font-semibold text-lg mb-6">
                Detail Kursus
            </h2>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            function removeImage(id) {
                $(`.image-container-${id}`).removeClass('hidden');
                $(`.preview-image-${id}`).addClass('hidden');
                $(`#${id}`).val('');
            }

            $(function() {
                ClassicEditor.create(document.querySelector("#short_description")).catch((error) => {
                    console.error(error);
                });
                ClassicEditor.create(document.querySelector("#description")).catch((error) => {
                    console.error(error);
                });

                $('#main_image').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('.image-container-main_image').addClass('hidden');
                        $('.preview-image-main_image').removeClass('hidden');
                        $('.preview-image-main_image img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>
    @endpush

</x-app-layout>
