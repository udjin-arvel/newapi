<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:site_name" content="Arvelov">
        <meta name="application-name" content="Arvelov">
        <meta name="description" content="Частная web-студия">

        <meta property="og:title" content="ArvelovGroup">
        <meta property="og:description" content="Частная web-студия">
        <meta property="og:image" content="https://arvelov.online/logo.png">
        <meta property="og:url" content="https://arvelov.online">
        <meta property="og:type" content="website">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Arvelov">
        <meta name="twitter:description" content="Частная web-студия">
        <meta name="twitter:image" content="https://arvelov.online/logo.png">

        <title>Arvelov</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
    </body>
</html>
