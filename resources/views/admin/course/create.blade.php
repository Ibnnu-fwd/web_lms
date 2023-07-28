<x-app-layout>
    <x-breadcrumb name="course.create" />

    <x-card-container class="md:grid grid-cols-2 gap-8">
        <div>
            <h2 class="font-semibold text-xl mb-8">
                Informasi Kursus
            </h2>

            <x-input id="title" name="title" type="text" label="Judul" />
            <x-select id="category_id" name="category_id" title="Kategori">

            </x-select>

        </div>
    </x-card-container>
</x-app-layout>
