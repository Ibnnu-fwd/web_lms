<x-app-layout>
    <x-breadcrumb name="user-transaction" />
    <x-card-container>

        <table id="transactionTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Transaksi</th>
                    <th>Tipe</th>
                    <th>Kustomer</th>
                    <th>Sub Total</th>
                    <th>Total Pembayaran</th>
                    <th>Status Pemesanan</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#transactionTable').DataTable({
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
                            data: 'transaction_code',
                            name: 'transaction_code'
                        },
                        {
                            data: 'transaction_type',
                            name: 'transaction_type'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'sub_total',
                            name: 'sub_total'
                        },
                        {
                            data: 'total_payment',
                            name: 'total_payment'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status'
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
