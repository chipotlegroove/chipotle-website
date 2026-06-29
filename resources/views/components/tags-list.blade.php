@props(['tags', 'selectedTags'])
<div class="grid grid-cols-2 w-56 gap-x-2 gap-y-1"
    x-data="{
        selectedTags: @js($selectedTags),
        handleSelectTag(tag) {
            this.selectedTags = !this.selectedTags.includes(tag) ? [...this.selectedTags, tag] : this.selectedTags.filter((tagInArray) => tagInArray !== tag);
            this.$dispatch('tag-selected', this.selectedTags);
        }
    }"
    @reset-tags.window="selectedTags =[]"
    >
    @forelse ($tags as $tag)
        <x-tag-clip @click="handleSelectTag('{{ $tag->slug }}')" x-bind:style="selectedTags.includes('{{ $tag->slug }}') && 'background-color: var(--color-brown)'" :label="$tag->label" />
    @empty
        <p>No tags yet..</p>
    @endforelse
</div>
