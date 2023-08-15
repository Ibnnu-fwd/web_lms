@props(['title' => '', 'color' => 'primary', 'font' => 'font-medium', 'route' => '#', 'id' => ''])

<a href="{{ $route }}" id="{{ $id }}"
    {{ $attributes->merge(['class' => 'inline-flex justify-center rounded-md bg-' . $color . ' px-3 py-1.5 text-xs 2xl:text-sm ' . $font . ' leading-6 text-white shadow-sm hover:bg-' . $color . ' focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-' . $color . '']) }}>
    {{ ucwords($title) }}
</a>
