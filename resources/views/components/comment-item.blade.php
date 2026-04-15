@props(['comment', 'depth'])
<div x-data="{
    open: false,
    }"
    @close-all-reply-forms.window = "open = false" style="margin-left: {{ $depth * 16 }}px"
    class="border-b border-gray-300 pb-4" id="comment-{{ $comment->getKey() }}">
    <p class="font-bold text-lg">Anonymous</p>
    <x-clampable-text :text="$comment->body" />
    <div class="flex space-x-4 w-fit">
        <button class="inline-flex text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
            @click="if (!open) { $dispatch('close-all-reply-forms'); open=true; }">Reply</button>
        @if ($comment->parent_id)
            <button class="text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
                @click="document.getElementById('comment-{{ $comment->rootAncestor->getKey() }}').scrollIntoView({ behavior: 'smooth' })">
                Start of thread
            </button>
        @endif
    </div>
    <template x-if="open">
        <x-comment-form :showClose="true" action="/comments/{{ $comment->id }}/replies" />
    </template>
</div>
