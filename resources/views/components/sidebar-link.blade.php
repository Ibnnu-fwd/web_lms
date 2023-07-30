@props(['route', 'icon' => '', 'title' => '', 'active' => false])

<li>
    <a href="{{ $route }}"
        {{ $attributes->merge([
            'class' =>
                'inline-flex items-center w-full px-4 py-2 mt-1 text-xs 2xl:text-sm transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 ' .
                ($active ? 'text-primary' : 'text-gray-500 hover:text-primary'),
        ]) }}>
        <ion-icon class="w-4 h-4 md hydrated" name="{{ $icon }}" role="img" aria-label="aperture outline">
        </ion-icon>
        <span class="ml-4">
            {{ $title }}
        </span>
    </a>
</li>
