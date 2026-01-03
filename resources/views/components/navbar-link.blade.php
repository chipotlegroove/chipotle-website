@props([
    "active"
])

<a {{ $attributes->class([
    "inline-block text-white text-lg hover:scale-[1.15] hover:underline transition",
    'font-bold' => $active
]) }}> {{ $slot }}</a>
