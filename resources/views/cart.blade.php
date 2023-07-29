    <x-user-layout>
        <div class="container mx-auto mb-20 min-h-screen">
            <h1
                class="leading-relaxed font-primary font-extrabold text-4xl text-center text-palette-primary mt-4 py-2 sm:py-4">
                Pesanan Anda</h1>
            <div class="min-h-80 max-w-7xl my-4 sm:my-8 mx-auto w-full">
                <table class="mx-auto">
                    <thead>
                        <tr class="uppercase text-xs sm:text-sm text-palette-primary border-b border-palette-light">
                            <th class="font-primary font-normal px-6 py-4">Course</th>
                            <th class="font-primary font-normal px-6 py-4">Sewa / bulan</th>
                            <th class="font-primary font-normal px-6 py-4 hidden sm:table-cell">Harga</th>
                            <th class="font-primary font-normal px-6 py-4">Remove</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-palette-lighter">
                        <tr class="text-sm sm:text-base text-gray-600 text-center">
                            <td class="font-primary font-medium px-6 sm:px-6 py-4 flex items-center">
                                <img src="https://images.unsplash.com/photo-1588690154757-badf4644190f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8a290bGlufGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                                    alt="fashion-dog" class="hidden sm:inline-flex rounded-md me-2" width="64"
                                    height="64">
                                <a class="pt-1 hover:text-palette-dark" href="/products/the-fashionista">Belajar
                                    Pemrograman Kotlin</a>
                            </td>
                            <td class="font-primary font-medium px-4 sm:px-6 py-4"><input type="number"
                                    inputmode="numeric" id="variant-quantity" name="variant-quantity" min="1"
                                    step="1"
                                    class="text-gray-900 form-input border border-gray-300 w-16 rounded-sm focus:border-palette-light focus:ring-palette-light"
                                    value="1"></td>
                            <td class="font-primary text-base font-light px-4 sm:px-6 py-4 hidden sm:table-cell">
                                Rp.<span class="text-lg">2.000.000</span></td>
                            <td class="font-primary font-medium px-4 sm:px-6 py-4"><button aria-label="delete-item"
                                    class=""><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="times"
                                        class="svg-inline--fa fa-times fa-w-11 w-8 h-8 text-palette-primary border border-palette-primary p-1 hover:bg-palette-lighter"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                        <path fill="currentColor"
                                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                        </path>
                                    </svg></button></td>
                        </tr>
                        <tr class="text-sm sm:text-base text-gray-600 text-center">
                            <td class="font-primary font-medium px-6 sm:px-6 py-4 flex items-center">
                                <img src="https://images.unsplash.com/photo-1588690154757-badf4644190f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8a290bGlufGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                                    alt="fashion-dog" class="hidden sm:inline-flex rounded-md me-2" width="64"
                                    height="64">
                                <a class="pt-1 hover:text-palette-dark" href="/products/the-fashionista">Belajar
                                    Pemrograman Kotlin</a>
                            </td>
                            <td class="font-primary font-medium px-4 sm:px-6 py-4"><input type="number"
                                    inputmode="numeric" id="variant-quantity" name="variant-quantity" min="1"
                                    step="1"
                                    class="text-gray-900 form-input border border-gray-300 w-16 rounded-sm focus:border-palette-light focus:ring-palette-light"
                                    value="1"></td>
                            <td class="font-primary text-base font-light px-4 sm:px-6 py-4 hidden sm:table-cell">
                                Rp.<span class="text-lg">2.000.000</span></td>
                            <td class="font-primary font-medium px-4 sm:px-6 py-4"><button aria-label="delete-item"
                                    class=""><svg aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="times"
                                        class="svg-inline--fa fa-times fa-w-11 w-8 h-8 text-palette-primary border border-palette-primary p-1 hover:bg-palette-lighter"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                        <path fill="currentColor"
                                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                        </path>
                                    </svg></button></td>
                        </tr>
                        <tr class="text-center">
                            <td></td>
                            <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">
                                Subtotal</td>
                            <td class="font-primary text-lg text-palette-primary font-medium px-4 sm:px-6 py-4">Rp.<span
                                    class="text-xl">4.000.000</span></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="max-w-md mx-auto space-y-4 px-2"> <a href="{{ route('admin.checkout') }}""> <button
                        class="mt-4 mb-8 w-full rounded-md bg-primary px-6 py-3 font-medium text-white">Checkout</button>
                </a>
            </div>
        </div>
    </x-user-layout>
