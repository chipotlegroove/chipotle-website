@props([ 'showClose' => false, 'formId'])
@php $isSubmittedForm = old('_form_id') === $formId @endphp
<div x-data='{content:@json($isSubmittedForm ? old("body") : "")}'>
    <form method="POST" {{ $attributes }} >
        @csrf
        @honeypot
        <input type="hidden" name="_form_id" value="{{ $formId }}">
        <div class="mt-2">
            @if ($formId == 'main')
            <p class="text-xs text-stone-500">
                Your email will not be displayed on the comment. It is only stored to
                notify you when someone replies to your comment and will be deleted after 30 days.
            </p>
            @endif
            <input type="text" name="email" id="email"
                class="w-full mt-2 px-4 py-2 border border-stone-400 rounded" placeholder="email@email.com"
                value="{{ old('email') }}">
        </div>
        <textarea name="body" id="body" rows="5" placeholder="Say something nice..."
            class="w-full mt-4 px-4 py-2 border border-stone-400 rounded" x-model="content"></textarea>
        @if ($isSubmittedForm)
        @error('body')
            <div class="font-semibold text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror
        @endif
        <div class="mt-1 flex justify-between items-center">
                <p class="text-sm" :class="{'text-amber-600 font-bold': content.length > 7000, 'text-red-600 font-bold animate-pulse':content.length >= 10000}">
                    <span x-text="content.length"></span>
                    <span>/ 10000</span>
                </p>
            <div @class([
                'flex',
                'justify-between space-x-1' => $showClose,
                'justify-end' => !$showClose,
            ])>
                <x-main-button type="submit" class="group">
                    <x-animated-icon-label icon="paper-airplane" text="Post"/>
                </x-main-button>
                @if ($showClose)
                    <x-cancel-button type="button" @click="$dispatch('close-all-reply-forms')">
                        <x-icon-x-circle class="size-6 hover:text-black/50 transition-colors duration-300"/>
                    </x-cancel-button>
                @endif
            </div>
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
