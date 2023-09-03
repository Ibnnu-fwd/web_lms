@props(['chapter', 'active', 'isLast' => false, 'isFirst' => false, 'isCompleted' => false, 'route' => '#', 'title' => ''])

<li>
    <a href="{{ $isCompleted
        ? $route
        : ($isFirst
            ? route('user.learning.chapter', $chapter)
            : ($isLast
                ? route('user.learning.chapter', $chapter)
                : '#')) }}"
        class="flex items-center p-2 border text-gray-900 rounded-lg hover:bg-gray-100 group">
        <ion-icon
            name="{{ $isCompleted
                ? 'checkmark-circle-outline'
                : ($isFirst
                    ? 'play-circle-outline'
                    : ($isLast
                        ? 'stop-circle-outline'
                        : 'ellipse-outline')) }}"
            class="text-xl text-gray-500 group-hover:text-gray-900"></ion-icon>
        <span class="ml-3">
            {{ $title }}
        </span>
    </a>
</li>
