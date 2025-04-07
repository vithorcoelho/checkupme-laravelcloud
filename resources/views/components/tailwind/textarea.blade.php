<div>
    @if(isset($label))
        <label for="{{ $name ?? '' }}" class="block text-sm/6 font-medium text-gray-900 mb-2">{{ $label ?? '' }}</label>
    @endif

    <textarea
        {{ $attributes }}
        wire:model="{{ $name ?? '' }}"
        x-data="{
            resize: () => {
                $el.style.height = 'auto';
                $el.style.height = $el.scrollHeight + 'px';
            }
        }"
        x-init="resize()"
        @input="resize()"
        wire:model.defer="{{ $name ?? '' }}"
        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 resize-y"
    ></textarea>

    @error(isset($name))
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>
