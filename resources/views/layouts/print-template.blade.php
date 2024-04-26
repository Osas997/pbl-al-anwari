<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>{{ $title ?? config('app.name') }}</title>
   <style>
      @media print {
         body * {
            visibility: hidden;
         }

         .print-container,
         .print-container * {
            visibility: visible;
            max-width: 100% !important;
            box-shadow: none !important;
         }

         .print-container {
            border: none;
         }
      }
   </style>

   @vite(['resources/css/guest.css'])

</head>

<body>
   <div class="">
      {{ $slot }}
   </div>

   @stack('script')
</body>

</html>