@if (session()->has('success'))
<div class="fixed p-2 text-sm text-white bg-green-700 rounded bottom-3 right-3" x-data="{show:true}" x-init="setTimeout(()=>show=false, 4000)" x-show="show">
    <p>
        {{ session('success') }}
    </p>
</div>
    @elseif (session()->has('error'))
    <div class="fixed p-2 text-sm text-red-900 bg-red-200 rounded bottom-3 right-3" x-data="{show:true}" x-init="setTimeout(()=>show=false, 4000)" x-show="show">
        <p>
            {{ session('error') }}
        </p>
    </div>

@endif
