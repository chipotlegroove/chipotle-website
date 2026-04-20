@props(['comments', 'depth', 'rootId' => 0])
<div class="flex flex-col space-y-4">
    @foreach ($comments as $comment)
    <x-comment-item :comment="$comment" :depth="$depth" :rootId="$rootId"/>
    @if (!empty($comment->children) && $comment->children->count())
        @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1, 'rootId' => $rootId === 0 ? $comment->getKey() : $rootId])
    @endif
    @endforeach
</div>
