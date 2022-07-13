<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="css/app.css"/>
</head>
<body>
    @include('layouts.side')

    <div class="right-content">
        @include('layouts.header')

        <div class="container">
            @yield('content')
        </div>
    </div>


    <script src="js/app.js"></script>
</body>
</html>
