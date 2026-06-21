@props(['comment', 'depth', 'rootId'])
<div x-data="{
    open: false,
    childListOpen: true,
    }"
    @close-all-reply-forms.window = "open = false"
    class="py-4 {{ $depth > 0 ? 'pl-4 border-l-2 border-gray-400' : '' }}">
    <div id="comment-{{ $comment->getKey() }}" class="transition-colors duration-300 ease-in-out">
        <div class="flex space-x-2 items-baseline">
            <p class="font-bold text-lg">Anonymous</p>
            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <x-clampable-text :text="$comment->body" />
        <div class="flex space-x-4 w-full mt-4 pb-4 border-b border-gray-300">
            @if ($comment->children->count() > 0)
            <button class="inline-flex hover:text-light-brown cursor-pointer transition-colors"
                @click="childListOpen = !childListOpen">
                    <template x-if="childListOpen">
                         <x-animated-icon-label icon="chevron-down" text="Collapse children"/>
                    </template>
                    <template x-if="!childListOpen">
                        <x-animated-icon-label icon="chevron-up" text="Show children"/>
                    </template>
            </button>
            @endif
            <button class="inline-flex hover:text-light-brown cursor-pointer transition-colors" :class="{'text-light-brown': $store.reply.id === {{ $comment->id }}}"
                @click="$store.reply.toggle({{ $comment->id }})">
                    <x-animated-icon-label x-bind:class="{'max-w-sm opacity-100 translate-x-0': $store.reply.id === {{ $comment->id }}}" icon="chat-bubble-left-right" text="Reply"/>
            </button>
            @if ($comment->parent_id)
            <button class=" hover:text-light-brown cursor-pointer transition-colors"
                    @click="handleStartOfThread({{ $rootId }})">
                        <x-animated-icon-label icon="arrow-uturn-up" text="Start of thread"/>
            </button>
            @endif
        </div>
    </div>
    <div x-show="$store.reply.id === {{ $comment->id }}"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        id="reply-anchor-{{ $comment->id }}"
    >
    </div>
    <div x-show="childListOpen">
    @if ($depth < 7)
        @if (!empty($comment->children) && $comment->children->count())
        @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1, 'rootId' => $rootId === 0 ? $comment->getKey() : $rootId])
        @endif
    @else
    <a class="text-sm text-light-brown hover:text-brown transition-colors duration-300 cursor-pointer" href="{{route('posts.show', ['post'=>$comment->post->slug, 'comment'=>$comment->parent->id])}}">Show more in thread</a>
    @endif
    </div>
</div>
