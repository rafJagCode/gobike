<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet"> 
        <title>GoBike</title>
    </head>
    <body>
        <div id="app">
        </div>
        <script type=text/javascript src="js/app.js"></script>
    </body>
</html>