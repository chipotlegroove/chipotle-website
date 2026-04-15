@props(['comments', 'depth'])
<div class="flex flex-col space-y-4">
    @foreach ($comments as $comment)
    <x-comment-item :comment="$comment" :depth="$depth"/>
    @if (!empty($comment->children) && $comment->children->count())
        @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1])
    @endif
    @endforeach
</div>
