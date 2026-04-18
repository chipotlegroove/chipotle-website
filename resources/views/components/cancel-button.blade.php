@props(['label'])
<button {{ $attributes->merge(['class' => 'cursor-pointer hover:text-black transition-colors']) }}>
    {{ $label }}
</button>
