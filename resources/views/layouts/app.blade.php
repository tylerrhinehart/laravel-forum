<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
      window.App = {!! json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth::user()
        ]) !!}
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.4/trix.css" />

    @yield('header')

    <style>
        body {
            padding-bottom: 100px;
        }

        .level {
            display: flex;
            align-items: center;
        }

        .flex {
            flex: 1;
        }

        .mr-1 {
            margin-right: 1em;
        }

        .ml-a {
            margin-left: auto;
        }

        [v-cloak] {
            display: none;
        }

        .ais-highlight > em {
            background-color: yellow;
            font-style: normal;
        }

        .ais-index {
            width: 100%;
            display: flex;
        }
    </style>
</head>
<body>
<div id="app">
    @include('layouts.nav')

    <main class="py-4">
        @yield('content')
    </main>

    <flash message="{{ session('flash') }}"></flash>
</div>
</body>
</html>
