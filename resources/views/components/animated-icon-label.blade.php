@props([
    'icon',
    'text'
])
<div x-data class="flex items-center space-x-1 group font-bold">
    @svg($icon, "size-4")
    <p  {{ $attributes->merge(['class' => 'opacity-0 max-w-0 -translate-x-2 group-hover:translate-x-0 group-hover:max-w-sm group-hover:opacity-100 text-sm transition-all duration-300 overflow-hidden whitespace-nowrap']) }}>{{ $text }}</p>
</div>
