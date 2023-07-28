<x-app-layout>
    <x-breadcrumb name="verificator.create" />
    <x-card-container class="w-full md:w-1/3">
        <h2 class="text-lg font-medium">
            Tambah Verifikator
        </h2>
        <p class="text-md mt-1 mb-4 text-gray-400">
            Tambah verifikator baru
        </p>
        <form action="" method="POST">
            @csrf
            <x-select id="user_id" title="Nama" name="user_id" class="w-full">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                @endforeach
            </x-select>
            <hr class="my-4">
            <x-button title="Simpan Perubahan" />
        </form>
    </x-card-container>
</x-app-layout>
