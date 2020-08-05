<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>DMS for Office and Dragons</title>
    </head>
    <body data-gr-c-s-loaded="true" cz-shortcut-listen="true">
        <div id="app">
            <vue-layout></vue-layout>
        </div>

        <script src="/js/app.js"></script>

    </body>
</html>
