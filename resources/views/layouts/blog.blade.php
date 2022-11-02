<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>My Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

      
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"  crossorigin="anonymous" />

        <!-- TailwindCss element -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />



        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

       
    </head>
    <body class="bg-gray-100 ">
        <div class="2xl:w-[1600px] w-full mx-auto relative" >
            <div class="shadow shadow-white py-7 bg-rose-900">
                {{ $header}}
            </div>
            {{$slot}}
            {{ $topPosts }}
            
            <footer class="bg-rose-900 mt-20 py-2 text-white text-center text-xs w-full">
                {{ __('© Copyright 2022 Blog | Powered by Umair') }}
            </footer>
        </div>


        <!-- TailwindCss js bundle -->
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

    </body>
</html>
