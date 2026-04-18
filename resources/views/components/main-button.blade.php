@props(['label'])
<button {{ $attributes->merge(['class' => "px-4 py-2 border rounded-lg cursor-pointer bg-light-brown text-white hover:bg-brown transition-colors"]) }}>
    {{ $label }}
</button>

