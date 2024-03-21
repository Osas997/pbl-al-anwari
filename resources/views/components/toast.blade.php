{{-- Toast --}}
<div x-data="{ open: false, timer: 5000, message: '' }" x-cloak
   x-on:toast.window="open = true; message = $event.detail; setTimeout(() => { open = false; }, timer);">
   <button type="button" x-show="open" x-transition.duration.300ms x-on:click="open = false"
      class="fixed right-12 lg:top-18 z-999999 rounded-md bg-green-500 px-4 py-2 text-white transition hover:bg-green-600">
      <div class="flex items-center space-x-2">
         <span class="text-3xl"><i class="bx bx-check"></i></span>
         <p class="font-bold" x-text="message"></p>
      </div>
   </button>
</div>