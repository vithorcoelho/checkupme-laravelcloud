<div>
    <div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-4 {{ $class ?? '' }}">
        @if(isset($title) || isset($subtitle))
        <div>
            <flux:heading size="lg" class="text-base/7 font-semibold">{{ $title ?? '' }}</flux:heading>
            <flux:text class="mt-2">{{ $subtitle ?? '' }}</flux:text>
        </div>
        @endif
    
        <div class="@if(!isset($transparent)) bg-white shadow-xs rounded-lg px-6 py-8 dark:bg-zinc-900 @endif col-span-3 ">
           {{ $slot }}
        </div>
    </div>
</div>