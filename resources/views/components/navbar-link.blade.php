@props(['active'])

<a
    {{ $attributes->class([
        'inline-block text-white text-lg hover:tracking-widest transition-all duration-300',
        'font-bold' => $active,
    ]) }}>
    {{ $slot }}</a>
