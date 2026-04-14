<x-layouts.app>
    <div x-data="{ 'replyId': 0 }">
        <section>
            <x-page-header :label="$post->title" />
            @if ($post->hasMedia('thumbnail'))
                <img src="{{ $post->getFirstMediaUrl('thumbnail') }}" alt="post-thumbnail" class="w-full mb-6 max-h-96">
            @endif
            <div class="text-sm text-gray-500">
                <p>Post created on: {{ $post->created_at->format('j F, Y') }}</p>
                <p>Post last updated on: {{ $post->updated_at->format('j F, Y') }}</p>
            </div>
            <p class="text-gray-600 mb-6">{{ $post->description }}</p>
            <div class="prose max-w-none">
                {!! str($post->body)->markdown()->sanitizeHtml()->toHtmlString() !!}
            </div>
        </section>
        <section class="mt-6">
            <x-page-header label="Comments" />
            <p>What did you think about this post? Let me know in the comments!</p>
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                @csrf
                <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
                    class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl"></textarea>
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="px-4 py-2 border rounded-lg cursor-pointer bg-light-brown text-white hover:bg-brown transition-colors">Post
                    </button>
                </div>
            </form>
            <div class="flex flex-col space-y-4">
                @foreach ($post->comments as $comment)
                    <div class="border-b border-gray-300 pb-4">
                        <p class="font-bold text-lg">Anonymous</p>
                        <p>{{ $comment->body }}</p>
                        <p class="inline-flex text-blue-500 hover:text-blue-700 cursor-pointer transition-colors"
                            @click="replyId={{ $comment->id }}">Reply</p>
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
                @endforeach
            </div>
        </section>

    </div>
</x-layouts.app>
