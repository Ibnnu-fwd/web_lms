<x-app-layout>
    <x-breadcrumb name="user-transaction" />
    <x-card-container>
        <div class="text-end mb-4">
        </div>
        <table id="courseCategoryTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe Transaksi</th>
                    <th>Customer</th>
                    <th>Sub Total</th>
                    <th>Total Pembayaran</th>
                    <th>Status Pemesanan</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#courseCategoryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('user.transaction') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'icon',
                            name: 'icon'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });
        </script>
    @endpush


</x-app-layout>
