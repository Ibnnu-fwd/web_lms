@props(['type' => 'submit', 'title' => '', 'color' => 'primary', 'font' => 'font-semibold'])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'flex w-full justify-center rounded-md bg-' . $color . ' px-3 py-1.5 text-sm ' . $font . ' leading-6 text-white shadow-sm hover:bg-secondary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary']) }}>
    {{ $title }}
</button>
