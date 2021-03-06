<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>todolist</title>
    <link rel="icon" href="{{ asset('/favicon.ico') }}">
  </head>
  <body>
    <noscript>
      <strong>We're sorry but todolist doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app">
        <my-app></my-app>
    </div>
    <!-- built files will be auto injected -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
