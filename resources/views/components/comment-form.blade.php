@props(['action', 'showClose' => false])
<div>
    <form method="POST" action="{{ $action }}">
        @csrf
        @honeypot
        <div>
            <label for="email" class="font-bold">E-Mail</label>
            <p class="text-xs text-gray-500">
                Your email will not be displayed on the comment. It is only stored to
                notify you when someone replies to your comment and will be deleted after 30 days.
            </p>
            <input type="text" name="email" id="email" value=""
                class="w-full mt-2 px-4 py-2 border border-gray-400 rounded-2xl" placeholder="email@email.com"
                value="{{ old('email') }}">
        </div>
        <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
            class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl" >{{ old('body') }}</textarea>
        @error('body')
            <div class="font-semibold text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror
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

@error('body')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { message: 'Your comment was posted successfully!', type: 'success' }
        }));
    })
</script>
@enderror
