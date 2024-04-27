<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">

   <title>{{ $title ?? config('app.name') }}</title>

   @vite(['resources/css/app.css' , 'resources/js/app.js'])
   @livewireStyles
</head>

<body x-data="{'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
   :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}" id="app" class="scroll-smooth">

   <!-- ===== Page Wrapper Start ===== -->
   <div class="flex h-screen overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      @include('partials.sidebar')
      <!-- ===== Sidebar End ===== -->

      <!-- ===== Content Area Start ===== -->
      <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
         <!-- ===== Header Start ===== -->
         @include('partials.header')
         <!-- ===== Header End ===== -->

         <!-- ===== Main Content Start ===== -->
         <main>
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
               {{ $slot }}
            </div>
         </main>
         <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
   </div>
   {{-- <x-modals name="test">
      <div class="p-6 mt-3">
         <h1 class="font-bold text-center text-2xl">Hello</h1>
      </div>
   </x-modals> --}}
   @livewireScripts
   @stack('script')
</body>

</html>