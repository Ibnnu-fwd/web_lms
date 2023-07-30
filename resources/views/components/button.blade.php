@props(['type' => 'submit', 'title' => '', 'color' => 'primary', 'font' => 'font-medium', 'colorHover' => 'secondary', 'id' => '', 'onclick' => ''])

<button type="{{ $type }}" id="{{ $id }}" onclick="{{ $onclick }}"
    {{ $attributes->merge(['class' => 'inline-flex justify-center rounded-md bg-' . $color . ' px-8 py-2 text-xs 2xl:text-sm ' . $font . ' leading-6 text-white shadow-sm hover:bg-' . $colorHover . ' focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-' . $colorHover . '']) }}>
    {{ $title }}
</button>
