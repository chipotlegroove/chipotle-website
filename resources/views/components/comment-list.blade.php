<div class="flex flex-col space-y-4">
    @foreach ($comments as $comment)
        <div style="margin-left: {{$depth * 16}}px" class="border-b border-gray-300 pb-4" x-ref="comment{{$comment->getKey()}}">
            <p class="font-bold text-lg">Anonymous</p>
            <p>{{ $comment->body }}</p>
            <div class="flex space-x-4 w-fit">
                <p class="inline-flex text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
                    @click="replyId={{ $comment->id }}">Reply</p>
                @if ($comment->parent_id)
                <button @click="$refs.comment{{$comment->rootAncestor->getKey()}}.scrollIntoView({ behavior: 'smooth' })">
                    Start of thread
                </button>
                @endif
            </div>
            <template x-if="{{ $comment->id }}===replyId">
                <div>
                    <form method="POST" action="/comments/{{ $comment->id }}/replies">
                        @csrf
                        <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
                            class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl"></textarea>
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="px-4 py-2 border rounded-lg cursor-pointer bg-light-brown text-white hover:bg-brown transition-colors">Post
                            </button>
                        </div>
                    </form>
                </div>
            </template>
        </div>
        @if(!empty($comment->children) && $comment->children->count())
        @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1])
        @endif
    @endforeach
</div>
