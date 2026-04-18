@props(['tags', 'selectedTags'])
<div class="flex space-x-1"
    x-data="{
        selectedTags: @js($selectedTags),
        handleSelectTag(tag) {
            this.selectedTags = !this.selectedTags.includes(tag) ? [...this.selectedTags, tag] : this.selectedTags.filter((tagInArray) => tagInArray !== tag);
            this.$dispatch('tag-selected', this.selectedTags);
        }
    }"
    @reset-tags.window="selectedTags =[]"
    >
    @foreach ($tags as $tag)
        <x-tag-clip @click="handleSelectTag('{{ $tag->slug }}')" x-bind:class="selectedTags.includes('{{ $tag->slug }}') && 'bg-sky-800 border-sky-500'" :label="$tag->label" />
    @endforeach
</div>
