@props(['comments', 'depth', 'rootId' => 0])
<div class="flex flex-col space-y-4" x-data="{open:false}">
    @foreach ($comments as $comment)
    <x-comment-item :comment="$comment" :depth="$depth" :rootId="$rootId"/>
    @endforeach
</div>
