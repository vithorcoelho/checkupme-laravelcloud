<div>
    @if(isset($label))
        <label for="{{ $name ?? '' }}" class="block text-sm/6 font-medium text-gray-900 mb-2">{{ $label ?? '' }}</label>
    @endif

    <input {{ $attributes }} id="{{ $id ?? '' }}" value="{{ $value ?? '' }}" wire:model="{{ $name ?? '' }}" type="text" autocomplete="given-name" class="block w-full rounded-md mb-2 bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">

    @error($name)
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>
