@if ($data->status_payment == 1)
@endif
<x-link-button route="{{ route('admin.transaction.detail', $data->id) }}" title="Detail" />
