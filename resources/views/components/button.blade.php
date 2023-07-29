@props(['type' => 'submit', 'title' => '', 'color' => 'primary', 'font' => 'font-semibold'])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'inline-flex justify-center rounded-md bg-' . $color . ' px-8 py-2 text-md ' . $font . ' leading-6 text-white shadow-sm hover:bg-secondary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary']) }}>
    {{ $title }}
</button>
