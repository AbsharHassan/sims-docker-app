@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="text-center fixed bottom-0 transform bg-black w-full px-5 py-3 text-white font-bold">
        {{ session('message') }}
    </div>
@endif