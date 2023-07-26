<x-user-layout>

    @push('css-internal')
        <style>
            @keyframes slideToLeft {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-100%);
                }
            }

            .logo-container {
                animation: slideToLeft 40s linear infinite;
            }

            @media (max-width: 640px) {

                /* Remove the animation property inside the media query for mobile mode */
                .logo-container {
                    animation: none;
                }
            }
        </style>
    @endpush

    <!-- Hero -->
    <section>
        <div class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-6xl">
            <div class="relative flex-col items-start m-auto align-middle">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-24">
                    <div class="relative items-center gap-12 m-auto lg:inline-flex md:order-first">
                        <div class="max-w-xl text-center lg:text-left">
                            <div>
                                <p class="text-4xl md:text-5xl tracking-tight text-black font-bold">
                                    Discover The Best Way To Learn
                                </p>
                                <p class="max-w-xl mt-4 text-base tracking-tight text-gray-600">
                                    Mulai belajar dengan mudah dan cepat dengan materi yang disajikan secara lengkap
                                </p>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center gap-3 mt-10 lg:flex-row lg:justify-start">
                                <a href="{{ route('register') }}"
                                    class="items-center justify-center w-full px-6 py-2.5  text-center text-white duration-200 bg-primary border-2 border-primary rounded-md inline-flex hover:bg-transparent hover:border-red hover:text-danger focus:outline-none lg:w-auto focus-visible:outline-red text-sm focus-visible:ring-red">
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order-first hidden md:inline-block w-full lg:mt-0">
                        <img class="object-cover object-center max-h-72 w-full mx-auto bg-gray-300 border lg:ml-auto"
                            alt="hero"
                            src="https://d33wubrfki0l68.cloudfront.net/2ef8f651607bb32a3fc3a21d71dfe37fe89e2c26/c954d/images/placeholders/square1.svg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners -->
    <section>
        <div class="relative items-center w-full bg-gray-50 px-5 py-12 mx-auto md:px-12 lg:px-16 max-w-7xl">
            <div class="mx-auto">
                <div class="grid grid-cols-2 gap-0.5 md:grid-cols-6">
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/2a4d2cdd794587314ad2034778712608ac32e37c/79f3b/images/logos/8.svg"
                            alt="logo">
                    </div>
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/aae3d6dfaee9138c485f5305dd33b7f80379edb4/64dd2/images/logos/2.svg"
                            alt="logo">
                    </div>
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/4dc5df63255f9f0c1f54c804dd3149cf11308507/b7a70/images/logos/3.svg"
                            alt="logo">
                    </div>
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/be7130b04bb6b932ed9222877a5e9146d80c0eba/6511d/images/logos/4.svg"
                            alt="logo">
                    </div>
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/456c999508e76cd199714cfa4fad3826ebb02216/9147b/images/logos/5.svg"
                            alt="logo">
                    </div>
                    <div class="flex justify-center col-span-1 px-8">
                        <img class="max-h-12"
                            src="https://d33wubrfki0l68.cloudfront.net/b5d09ea7476a226d10dd1235e071288761e51da7/e68ac/images/logos/6.svg"
                            alt="logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section>
        <div class="relative items-center w-full px-5 py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
            <div class="grid items-center grid-cols-1 gap-12 text-left lg:gap-24 md:grid-cols-2 lg:grid-cols-3">
                <div class="relative items-center gap-12 m-auto lg:inline-flex md:order-first">
                    <div class="mx-auto lg:max-w-7xl">
                        <ul role="list" class="grid grid-cols-2 gap-4 list-none lg:grid-cols-1 lg:gap-6">
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Easy onboarding
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Customer support
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="order-first hidden md:inline-block w-full mt-12 aspect-square lg:mt-0">
                    <img class="object-cover object-center w-full mx-auto bg-gray-300 border lg:ml-auto" alt="hero"
                        src="https://d33wubrfki0l68.cloudfront.net/2ef8f651607bb32a3fc3a21d71dfe37fe89e2c26/bc4e8/images/placeholders/square2.svg">
                </div>
                <div class="relative items-center gap-12 m-auto lg:inline-flex md:order-first">
                    <div class="mx-auto lg:max-w-7xl">
                        <ul role="list" class="grid grid-cols-2 gap-4 list-none lg:grid-cols-1 lg:gap-6">
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Easy onboarding
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Customer support
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why choose us -->
    <section>
        <div class="items-center w-full px-5 bg-white py-24 mx-auto md:px-12 lg:px-16 max-w-7xl">
            <div class="md:text-center">
                <div class="">
                    <p class="text-lg md:text-2xl text-black">
                        Mengapa memilih <span class="font-black text-primary">
                            {{ config('app.name') }}
                        </span>?
                    </p>
                    <p class=" mt-2 text-sm md:text-lg tracking-tight text-gray-600">
                        Pilihan bijak untuk berkembang bersama kami
                    </p>
                </div>
            </div>
            <div class="w-full mx-auto mt-12 text-left">
                <div class="relative items-center gap-12 m-auto lg:inline-flex md:order-first">
                    <div class="p-4 mx-auto lg:max-w-7xl lg:p-0">
                        <ul role="list" class="grid grid-cols-2 gap-4 list-none lg:grid-cols-3 lg:gap-12">
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Can I used Lexingtøn Themes for my site?
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Upswing securities passively index inverse bondholders
                                    capitalization financial health Moody's debt managed.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Will i get updates?
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Upswing securities passively index inverse bondholders
                                    capitalization financial health Moody's debt managed.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        How much do disputes cost?
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Upswing securities passively index inverse bondholders
                                    capitalization financial health Moody's debt managed.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        How do refunds work?
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Is there a fee to use Google Pay?
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="mt-5 text-lg font-medium leading-6 text-black">
                                        Customer support
                                    </p>
                                </div>
                                <div class="mt-2 text-gray-500 text-sm">
                                    Plus, our platform is constantly evolving to meet the changing needs.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-user-layout>
