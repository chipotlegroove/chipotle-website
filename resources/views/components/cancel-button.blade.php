<button {{ $attributes->
    merge(['class' => 'cursor-pointer hover:text-black transition-colors']) }}>
    {{ $slot }}
</button>
