<div class="flex space-x-4 px-8 py-6 bg-light-brown items-center">
    <a href="/" class="flex items-center justify-center space-x-4">
        <img src="{{ asset('images/app-logo.jpg') }}" alt="chipotles" class="size-24 rounded-full">
        <p class="font-semibold text-white uppercase tracking-widest">Chipotle's Website</p>
    </a>
    <div>
        <x-navbar-link href="{{ route('posts.index') }}" :active="Route::is('posts.*')">
            Posts
        </x-navbar-link>
        <x-navbar-link href="{{ route('tags.index') }}" :active="Route::is('tags.*')">
            Tags
        </x-navbar-link>
    </div>
</div>
