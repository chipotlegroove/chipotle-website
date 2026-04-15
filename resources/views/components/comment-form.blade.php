@props([
    'action',
    'showClose' => false
])
<div>
    <form method="POST" action="{{$action}}">
        @csrf
        <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
            class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl"></textarea>
        <div @class([
                'flex',
                'justify-between' => $showClose,
                'justify-end' => !$showClose,
                'mt-4'
             ])>
            @if ($showClose)
            <button type="button" @click="$dispatch('close-all-reply-forms')" class="cursor-pointer hover:text-black transition-colors">
                Close
            </button>
            @endif
            <button type="submit"
                class="px-4 py-2 border rounded-lg cursor-pointer bg-light-brown text-white hover:bg-brown transition-colors">Post
            </button>
        </div>
    </form>
</div>
