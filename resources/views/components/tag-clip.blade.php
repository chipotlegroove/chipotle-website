@props([
    'label'
])
<span
    {{ $attributes->merge(['class' => 'cursor-pointer bg-sky-600 text-white text-sm px-2 py-1 rounded-xl hover:bg-sky-700 hover:tracking-wide transition-all duration-300 border']) }}>
    {{ $label }}
</span>
