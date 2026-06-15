<x-layouts.app>
    <section>
        <x-page-header :label="$post->title" />
        @if ($post->hasMedia('thumbnail'))
            <img src="{{ $post->getFirstMediaUrl('thumbnail') }}" alt="post-thumbnail" class="w-full mb-6 max-h-96">
        @endif
        <div class="text-sm text-gray-500">
            <p>Post created on: {{ $post->published_at->format('j F, Y') }}</p>
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
        <x-comment-form action="/posts/{{ $post->id }}/comments" form-id="main"/>
        @if ($comments->count() > 0)
        @include('comment-list', ['comments' => $comments, 'depth' => 0])
        {{ $comments->links() }}
        @else
        <x-no-results label="No comments have been posted here" />
        @endif
    </section>
</x-layouts.app>
<x-toast/>
@if (session('isSpam') === true)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: 'Your comment was flagged as spam...', type: 'alert'}
            }));
        })
   </script>
@endif
@if (session('isSpam') === false)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: 'Thank you for your comment!', type: 'success' }
            }));
        })
    </script>
@endif
