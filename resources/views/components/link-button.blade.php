@props(['title' => '', 'color' => 'primary', 'font' => 'font-semibold', 'route' => '#'])

<a href="{{ $route }}"
    {{ $attributes->merge(['class' => 'inline-flex justify-center rounded-md bg-' . $color . ' px-3 py-1.5 text-xs 2xl:text-sm ' . $font . ' leading-6 text-white shadow-sm hover:bg-' . $color . ' focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-' . $color . '']) }}>
    {{ $title }}
</a>
