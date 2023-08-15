<x-user-layout class="relative items-center w-full py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
    <div class="container mx-auto mb-20 min-h-screen">
        <h1 class="leading-relaxed font-primary font-medium text-3xl text-center text-palette-primary mt-4 py-2 sm:py-4">
            Pesanan Anda
        </h1>
        <div class="min-h-80 max-w-7xl my-4 sm:my-8 mx-auto w-full">
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
                        @foreach ($carts as $cart)
                        <tr class="text-sm sm:text-base text-gray-600 ">
                            <td class="font-primary font-medium mr-2 py-4 flex items-center text-left gap-3 px-4">
                                <img src="{{asset('storage/courses/' . $cart['main_image'])}}"
                                    alt="fashion-dog" class="hidden sm:inline-flex rounded-md me-2 h-16 w-16">
                                <p class="pt-1 hover:text-palette-dark w-full" href="#">
                                    {{{$cart['name']}}}
                                </p>
                            </td>
                            <td class="font-primary px-4 sm:px-6 py-4 text-center">
                                <input type="number" inputmode="numeric" id="variant-quantity" name="variant-quantity"
                                    min="{{
                                        auth()->user()->role == 2 ? 3 : 1
                                    }}" step="1"
                                    class="text-gray-900 form-input border border-gray-300 w-16 rounded-md focus:border-primary focus:ring-primary"
                                    value="{{$cart['rent_month']}}">
                            </td>
                            <td
                                class="font-primary text-base font-light px-4 sm:px-6 py-4 hidden sm:table-cell text-center">
                                Rp.<span class="text-lg">
                                    {{number_format($cart['price'], 0, ',', '.')}}
                                </span>
                            </td>
                            <td class="font-primary px-4 sm:px-6 py-4 text-center">
                                Rp.<span class="text-lg">
                                    {{number_format($cart['total_price'], 0, ',', '.')}}
                                </span>
                            </td>
                            <td class="font-primary font-medium px-4 sm:px-6 py-4 text-center">
                                <button aria-label="delete-item"><svg aria-hidden="true" focusable="false" onclick="deleteItem({{$cart['id']}})" data-prefix="fas" data-icon="times"
                                        data-prefix="fas" data-icon="times"
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
                    </tbody>
                </table>
            </div>
        </div>
        <div class="max-w-md mx-auto space-y-4 px-2">
            <a href="{{ route('user.checkout') }}">
                <button class="mt-4 mb-8 w-full rounded-md bg-primary px-3 py-3 font-medium text-lg text-white">
                    Checkout
                </button>
            </a>
        </div>
    </div>

    @push('js-internal')
        <script>
            function deleteItem(id)
            {
                $.ajax({
                    url: "{{ route('user.cart.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function (response) {
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
        </script>
    @endpush
</x-user-layout>
