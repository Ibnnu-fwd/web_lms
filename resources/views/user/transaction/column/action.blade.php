<div class="flex items-center">
    @if ($data->status_payment == 0)
        <x-link-button route="{{ route('user.transaction.edit', $data->id) }}" title="Unggah Bukti Pembayaran"
            color="dark" />
    @elseif ($data->status_payment == 1)
        <x-link-button route="{{ route('user.transaction.edit', $data->id) }}" title="Menunggu Konfirmasi Pembayaran"
            color="dark" />
    @elseif ($data->status_payment == 2)
        <x-link-button route="{{ route('user.transaction.edit', $data->id) }}" title="Pembayaran Diterima"
            color="dark" />
    @elseif ($data->status_payment == 3)
        <x-link-button route="{{ route('user.transaction.edit', $data->id) }}" title="Pembayaran Ditolak"
            color="dark" />
    @endif
</div>
