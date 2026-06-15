@props(['action', 'showClose' => false, 'formId'])
@php $isSubmittedForm = old('_form_id') === $formId @endphp
<div x-data='{content:@json($isSubmittedForm ? old("body") : "")}'>
    <form method="POST" action="{{ $action }}">
        @csrf
        @honeypot
        <input type="hidden" name="_form_id" value="{{ $formId }}">
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
            class="w-full mt-4 px-4 py-2 border border-gray-400 rounded-2xl" x-model="content"></textarea>
        @if ($isSubmittedForm)
        @error('body')
            <div class="font-semibold text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror
        @endif
        <div class="mt-2">
            <p class="text-sm" :class="{'text-orange-300 font-bold': content && content.length > 7000, 'text-red-500 font-bold animate-pulse': content && content.length >= 10000}">
                <span x-text="content ? content.length : '0'"></span>
                <span>/ 10000</span>
            </p>
        </div>
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
            detail: { message: 'Thank you for you comment!', type: 'success' }
        }));
    })
</script>
@enderror
