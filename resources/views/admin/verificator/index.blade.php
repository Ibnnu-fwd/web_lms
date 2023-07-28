<x-app-layout>
    <x-breadcrumb name="verificator" />

    <x-card-container>
        <div class="text-end mb-4">
            <x-link-button type="button" title="Tambah verifikator" class="bg-gray-700 hover:bg-gray-600"
                route="{{ route('admin.verificator.create') }}" />
        </div>
        <table id="verificatorTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama lengkap</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Bergabung sejak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#verificatorTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.verificator.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'password',
                            name: 'password'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
