<div x-cloak x-data="{ show: false, message: '', type: 'success' }"
    x-on:toast.window="message = $event.detail.message; type = $event.detail.type; show = true; setTimeout(() => show = false, 3500)"
    style="position: fixed; bottom: 1.5rem; left: 50%; transform: translateX(-50%); z-index: 50; width: 390px; pointer-events: none;">
    <div x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" style="pointer-events: all;">
        <div x-bind:class="{
                'bg-yellow-500' : type==='alert',
                'bg-green-500' : type==='success',
            }"
                class="flex space-x-2 items-center text-white px-4 py-2 rounded-xl font-bold">
            <x-icon-exclamation-triangle x-show="type==='alert'"/>
            <x-icon-check-circle x-show="type==='success'"/>
            <span x-text="message"></span>
            </div>
    </div>
</div>
