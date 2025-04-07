<div>
    <div class="mt-2">
        <div class="flex items-center mb-4">
            <input {{ $attributes }} wire:model="{{ $name ?? '' }}" checked value="true" id="verify-checkbox" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{ $name ?? '' }}"
                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label ?? '' }}</label>
        </div>
        @error(isset($name))
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
</div>
