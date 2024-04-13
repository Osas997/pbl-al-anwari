@props([
'name',
'header',
'width' => 'max-w-xl',
'margin' => 'my-22',
])


<div x-data="{ modelOpen: false }" x-on:open-modal.window="$event.detail == '{{ $name }}' ? modelOpen = true : null"
   x-on:close-modal.window="$event.detail == '{{ $name }}' ? modelOpen = false : null"
   x-on:close.stop="modelOpen = false" x-on:keydown.escape.window="modelOpen = false">
   <div x-show="modelOpen" class="fixed inset-0 z-999999 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
      aria-modal="true">
      <div class="flex items-start justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
         <div x-cloak @click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-slate-800 bg-opacity-70" aria-hidden="true"></div>

         <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full {{ $width }} {{ $margin }} overflow-hidden text-left transition-all transform bg-white dark:bg-slate-800 rounded-lg shadow-xl 2xl:max-w-2xl">
            <div class="flex items-center p-6 justify-between space-x-4">
               <h1 class="text-xl font-medium text-gray-800 dark:text-white">{{ $header }}</h1>

               <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
               </button>
            </div>
            <hr>
            <div class="p-6">
               {{ $slot }}
            </div>
         </div>
      </div>
   </div>
</div>