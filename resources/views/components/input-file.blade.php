@props(['id' => '', 'name' => '', 'label' => '', 'required' => false])

<div class="mb-4">
    <label class="block mb-2 text-sm font-medium text-gray-900">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <div class="image-container-{{ $id }}">
        <div class="flex items-center justify-center w-full">
            <label for="{{ $id }}"
                class="flex flex-col items-center justify-center w-full h-32 border-0 ring-1 ring-inset ring-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-10">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-4 h-4 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="text-sm text-gray-500">
                        Unggah gambar
                    </p>
                </div>
                <input id="{{ $id }}" name="{{ $name }}" type="file" class="hidden" />
            </label>

            @error($name)
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="preview-image-{{ $id }} hidden">
        <div class="w-full">
            <img class="w-full h-32 border-0 rounded-lg object-cover object-center" src=""
                alt="preview image" />
            <button type="button"
                class="px-4 py-2 w-full mt-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600"
                onclick="removeImage('{{ $id }}')">
                Hapus Gambar
            </button>
        </div>
    </div>
</div>
