<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @inertiaHead
    <link rel="icon" href="{{ $page['props']['app']['favicon'] ?? '/images/favicon.ico' }}">
  </head>
  <body>
    @inertia
  </body>
</html>