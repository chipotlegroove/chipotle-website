@props(['text'])
<div x-data="{
    expanded: false,
    shouldClamp: false,
    buttonText: 'Read more',
    handleClick() {
        this.expanded = !this.expanded;
        this.buttonText = this.expanded ? 'Read less' : 'Read more'
    }}"
    x-init="$nextTick(() => {
    shouldClamp = $refs.text.scrollHeight > $refs.text.clientHeight
    })"
>
    <p :class="{ 'line-clamp-6': !expanded, 'line-clamp-none': expanded }" x-ref="text">
        {{ $text }}
    </p>
    <template x-if="shouldClamp">
        <button type="button" class="cursor-pointer text-sm text-blue-500 hover:text-blue-800 transition-colors"
            x-text="buttonText"
            @click="handleClick"></button>
    </template>
</div>
