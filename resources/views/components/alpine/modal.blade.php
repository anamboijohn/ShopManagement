<style>
    [x-cloak] { display: none; }
</style>
<div x-data="{ showModal: false, value:false }" x-on:keydown.window.escape="showModal = false">

    <div x-on:click="showModal = !showModal">
        {{ $trigger }}
    </div>


    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 bg-slate-900/75"></div>

    <div x-cloak x-show="showModal" x-transition class="fixed inset-0 z-50 flex items-center justify-center">
        <div x-on:click.away="showModal = false" class="w-screen max-w-xl mx-auto bg-teal-100 rounded-lg h-60">
            <div class="mt-10 text-center mb-10">
                {{  $content }}
            </div>
            <div class="flex gap-10 justify-center mt-10" @click="showModal = false">
                {{ $buttons }}
            </div>
        </div>
    </div>
</div>
