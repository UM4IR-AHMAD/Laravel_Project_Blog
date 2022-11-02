<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"  crossorigin="anonymous" />
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Include Quill text tditor stylesheet --> 
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



        
    </head>
    <body class="font-sans antialiased">
        <div class="h-screen border-black border-2 flex relative bg-slate-100">
            
            <div class="w-1/6 h-full relative lg:-translate-x-0 md:-translate-x-0">
                @include('layouts.navigation')
            </div>

            <div class="w-full h-full  flex flex-col ">
                <header class="pr-3 basis-10 shadow-xl flex items-center justify-end bg-rose-900 ">
                    @include('layouts.topBar')
                </header>
                <div class="relative bg-slate-200 basis-32 lg:basis-20 shadow px-3  flex lg:flex-row flex-col-reverse items-center justify-evenly lg:justify-between">
                    <!-- Page Heading -->
                    {{ $header }}
                </div>

                <!-- Page Content -->
                <main class=" basis-11/12 overflow-auto ">
                    {{ $slot }}
                </main>
            </div>
           
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/myJS.js') }}" defer></script>

       
        {{-- creating the text editor --}}
        <script src="{{ asset('js/quill.js') }}"></script>
    </body>
</html>
