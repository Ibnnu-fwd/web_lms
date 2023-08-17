<x-user-layout class="relative items-center w-full py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
    <div class="container mx-auto mb-20 min-h-screen">
        <h1 class="leading-relaxed font-primary font-medium text-3xl text-center text-palette-primary mt-4 py-2 sm:py-4">
            Pesanan Anda
        </h1>

        <div class="min-h-80 max-w-7xl my-4 sm:my-8 mx-auto w-full">
            <div class="bg-gray-100 border text-gray-700 px-4 py-3 rounded relative mt-4 mb-4" role="alert">
                <span class="block sm:inline">
                    Jika anda ingin mengubah jumlah sewa, silahkan ubah pada kolom <strong
                        class="font-primary font-medium">Sewa / bulan</strong> dibawah ini.
                    <hr class="my-2">

                    <strong class="font-primary font-medium">Note:</strong> Jumlah sewa untuk
                    <strong class="font-medium">{{ $role }}</strong> minimal
                    <strong class="font-medium">{{ auth()->user()->role == 2 ? 6 : 1 }}</strong> bulan.
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-fixed">
                    <thead>
                        <tr class="uppercase text-xs sm:text-sm text-palette-primary border-b border-palette-light">
                            <th class="font-primary font-normal px-4 sm:px-6 py-4">Course</th>
                            <th class="font-primary font-normal px-4 sm:px-6 py-4">Sewa / bulan</th>
                            <th class="font-primary font-normal px-4 sm:px-6 py-4 hidden sm:table-cell">Harga</th>
                            <th class="font-primary font-normal px-4 sm:px-6 py-4">Total</th>
                            <th class="font-primary font-normal px-4 sm:px-6 py-4">Remove</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-palette-lighter">
                        @if (isset($carts))
                            @foreach ($carts as $cart)
                                <tr class="text-sm sm:text-base text-gray-600" data-id="{{ $cart['id'] }}">
                                    <td
                                        class="font-primary font-medium mr-2 py-4 flex items-center text-left gap-3 px-4">
                                        <img src="{{ asset('storage/courses/' . $cart['main_image']) }}"
                                            alt="fashion-dog" class="hidden sm:inline-flex rounded-md me-2 h-16 w-16">
                                        <p class="pt-1 hover:text-palette-dark w-full" href="#">
                                            {{ $cart['name'] }}
                                        </p>
                                    </td>
                                    <td class="font-primary px-4 sm:px-6 py-4 text-center">
                                        <input type="number" inputmode="numeric" id="rent_month" name="rent_month"
                                            min="{{ auth()->user()->role == 2 ? 3 : 1 }}" step="1"
                                            class="text-gray-900 form-input border border-gray-300 w-16 rounded-md focus:border-primary focus:ring-primary"
                                            value="{{ $cart['rent_month'] }}">
                                    </td>
                                    <td
                                        class="font-primary text-base font-light px-4 sm:px-6 py-4 hidden sm:table-cell text-center">
                                        Rp.<span class="text-lg">
                                            {{ number_format($cart['price'], 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="font-primary px-4 sm:px-6 py-4 text-center">
                                        Rp.<span class="text-lg">
                                            {{ number_format($cart['total_price'], 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="font-primary font-medium px-4 sm:px-6 py-4 text-center">
                                        <button aria-label="delete-item"><svg aria-hidden="true" focusable="false"
                                                onclick="deleteItem({{ $cart['id'] }})" data-prefix="fas"
                                                data-icon="times" data-prefix="fas" data-icon="times"
                                                class="svg-inline--fa fa-times rounded-md fa-w-11 w-8 h-8 text-palette-primary border border-palette-primary p-1 hover:bg-palette-lighter"
                                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                                <path fill="bg-primary"
                                                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                                </path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if (isset($cart))
            <div class="text-center">
                <a href="{{ route('checkout') }}">
                    <button class="mt-4 mb-8 rounded-md bg-primary px-5 py-3 text-md text-white">
                        Lanjutkan ke Pembayaran
                    </button>
                </a>
            </div>
        @else
            <div class="text-center">
                <a href="{{ route('product') }}">
                    <button class="mt-4 mb-8 rounded-md bg-primary px-5 py-3 text-md text-white">
                        Jelajahi Modul
                    </button>
                </a>
            </div>
        @endif
    </div>

    @push('js-internal')
        <script>
            function deleteItem(id) {
                Swal.fire({
                    icon: 'warning',
                    text: 'Apakah anda yakin ingin menghapus item ini?',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                    cancelButtonText: `Tidak`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cart.delete') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    }
                })
            }

            // set total price on change rent month
            $(document).on('change', '#rent_month', function() {
                let rent_month = $(this).val();
                let id = $(this).closest('tr').data('id');
                let min_rent_month = @json($minRentMonth);

                // rent month must't be less than 1 or null or undefined
                if (rent_month < min_rent_month || rent_month == null || rent_month == undefined ||
                    rent_month == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Jumlah sewa minimal ' + min_rent_month + ' bulan',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $(this).val(min_rent_month);
                    rent_month = min_rent_month;

                    return false;
                }

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        rent_month: rent_month
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            });
        </script>
    @endpush
</x-user-layout>
