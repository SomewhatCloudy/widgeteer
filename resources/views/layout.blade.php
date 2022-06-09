<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') @endif</title>

    @env('local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endenv

    <link rel="stylesheet" href="/css/app.css"/>

    <script type="text/javascript" src="/js/app.js" defer></script>
</head>

<body>
<div id="app">

    @yield('contents')

</div>
</body>
