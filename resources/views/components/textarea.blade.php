@props(['id' => '', 'name' => '', 'label' => '', 'required' => false])

<div class="mb-4 mt-2">
    <label for="{{ $id }}" class="block mb-2 text-xs 2xl:text-sm text-gray-900 ">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <textarea id="{{ $id }}" rows="4" name="{{ $name }}" {{ $required ? 'required' : '' }}
        class="block p-2.5 w-full text-xs 2xl:text-sm text-gray-900 
        rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">{{ $slot }}</textarea>

    @error($name)
        <small class="text-red-500">{{ $message }}</small>
    @enderror
</div>
