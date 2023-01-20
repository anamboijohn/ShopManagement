@props(['name',  'row'=>2, 'col'])
<div class="mb-6 form-group">
    <textarea required
        class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-900 focus:outline-none
        "
    rows={{ $row }} placeholder={{ $name }} name={{ $name }} id={{ $name }}>{{ $slot ?? old($name) }} </textarea>  <span class="validity"></span>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
