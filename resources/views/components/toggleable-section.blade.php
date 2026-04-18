@props(['label'])
<section x-cloak x-data="{
    show: true
}">
    <div class="flex items-center mb-4 space-x-2">
        <p {{ $attributes->class(['text-2xl font-semibold']) }}>{{ $label }}</p>
        <x-icon-chevron-down @click="show=!show" class="size-6 mt-1 transition-transform duration-300" x-bind:class="{ '-rotate-180' : show }"/>
    </div>
    <div x-show="show">
        {{ $slot }}
    </div>
</section>
