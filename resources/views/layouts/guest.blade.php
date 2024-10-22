<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="shortcut icon" href="{{ asset('images/Logo Pondok Baru.png') }}" type="image/x-icon">

   <title>{{ $title ?? config('app.name') }}</title>

   @vite(['resources/css/guest.css'])

   @livewireStyles
</head>

<body>
   <div class="container mx-auto">
      {{ $slot }}
   </div>
   @livewireScripts
</body>

</html>