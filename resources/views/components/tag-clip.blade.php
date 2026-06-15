@props([
    'label'
])
<span
    {{ $attributes->merge(['class' => 'text-center cursor-pointer bg-light-brown text-white text-sm px-2 py-1 rounded-xl hover:bg-brown hover:tracking-wide transition-all duration-300 border']) }}>
    {{ $label }}
</span>
