@props(['route', 'value'])
<form action={{ $route }} method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="{{ $value }}"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">

</form>
