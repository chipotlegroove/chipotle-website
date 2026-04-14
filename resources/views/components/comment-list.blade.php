@props(['comments', 'depth'])
<div class="flex flex-col space-y-4">
    @foreach ($comments as $comment)
        <div style="margin-left: {{ $depth * 16 }}px" class="border-b border-gray-300 pb-4"
            x-ref="comment{{ $comment->getKey() }}">
            <p class="font-bold text-lg">Anonymous</p>
            <x-clampable-text :text="$comment->body" />
            <div class="flex space-x-4 w-fit">
                <button class="inline-flex text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
                    @click="replyId={{ $comment->id }}">Reply</button>
                @if ($comment->parent_id)
                    <button class="text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
                        @click="$refs.comment{{ $comment->rootAncestor->getKey() }}.scrollIntoView({ behavior: 'smooth' })">
                        Start of thread
                    </button>
                @endif
            </div>
            <template x-if="{{ $comment->id }}===replyId">
                <x-comment-form :showClose="true" action="/comments/{{ $comment->id }}/replies"/>
            </template>
        </div>
        @if (!empty($comment->children) && $comment->children->count())
            <div>
                @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1])
            </div>
        @endif
    @endforeach
</div>
