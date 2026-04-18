@props(['action', 'showClose' => false])
<div>
    <form method="POST" action="{{ $action }}">
        @csrf
        @honeypot
        <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
            class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl"></textarea>
        <div @class([
            'flex',
            'justify-between' => $showClose,
            'justify-end' => !$showClose,
            'mt-4',
        ])>
            @if ($showClose)
                <x-cancel-button type="button" @click="$dispatch('close-all-reply-forms')" label="Close" />
            @endif
            <x-main-button type="submit" label="Post" />
        </div>
    </form>
</div>
