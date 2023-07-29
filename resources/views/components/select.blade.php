@props(['title' => '', 'name', 'id', 'required' => false])

<div class="mb-4">
    <label for="{{ $id }}" class="block mb-2 text-md text-gray-900">
        {{ $title }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <select id="{{ $id }}" {{ $required ? 'required' : '' }}
        class="border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        name="{{ $name }}">
        {{ $slot }}
    </select>
    @error($name)
        <small class="text-red-500">{{ $message }}</small>
    @enderror
</div>
