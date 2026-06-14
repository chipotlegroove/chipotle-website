@props(['comment', 'depth', 'rootId'])
<div x-data="{
    open: false,
    childListOpen: true,
    }"
    @close-all-reply-forms.window = "open = false" style="margin-left: {{ $depth * 16 }}px"
    class="py-4" id="comment-{{ $comment->getKey() }}">
    <p class="font-bold text-lg">Anonymous</p>
    <x-clampable-text :text="$comment->body" />
    <div class="flex space-x-4 w-full mt-4 pb-4 border-b border-gray-300">
        @if ($comment->children->count() > 0)
        <button class="inline-flex hover:text-blue-700 cursor-pointer transition-colors"
            @click="childListOpen = !childListOpen">
                <template x-if="childListOpen">
                     <x-animated-icon-label icon="chevron-down" text="Collapse children"/>
                </template>
                <template x-if="!childListOpen">
                    <x-animated-icon-label icon="chevron-up" text="Show children"/>
                </template>
        </button>
        @endif
        <button class="inline-flex hover:text-blue-700 cursor-pointer transition-colors" :class="{'text-blue-700': open}"
            @click="if (!open) { $dispatch('close-all-reply-forms'); open=true; }">
                <x-animated-icon-label x-bind:class="{'max-w-sm opacity-100 translate-x-0': open}" icon="chat-bubble-left-right" text="Reply"/>
        </button>
        @if ($comment->parent_id)
        <button class=" hover:text-blue-700 cursor-pointer transition-colors"
                @click="document.getElementById('comment-{{ $rootId }}').scrollIntoView({ behavior: 'smooth' })">
                    <x-animated-icon-label icon="arrow-uturn-up" text="Start of thread"/>
        </button>
        @endif
    </div>
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <x-comment-form :showClose="true" action="/comments/{{ $comment->id }}/replies" />
    </div>
    <div x-show="childListOpen">
    @if (!empty($comment->children) && $comment->children->count())
    @include('comment-list', ['comments' => $comment->children, 'depth' => $depth + 1, 'rootId' => $rootId === 0 ? $comment->getKey() : $rootId])
    @endif
    </div>
</div>
