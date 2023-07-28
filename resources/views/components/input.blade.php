@props(['type' => 'text', 'name' => '', 'label' => '', 'id' => '', 'required' => false, 'value' => ''])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-md leading-6 text-gray-900">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <div class="mt-2">
        <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}"
            required
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 bg-none shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-primary sm:text-md sm:leading-6">
    </div>
</div>
