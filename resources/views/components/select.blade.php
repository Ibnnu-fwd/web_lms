@props(['title' => '', 'name', 'id'])

<label for="{{ $id }}" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">
    {{ $title }}
</label>
<select id="{{ $id }}"
    class="border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 "
    name="{{ $name }}">
    {{ $slot }}
</select>
