
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>UBG Website</title>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('fontawesome/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome/css/solid.min.css')}}">
  <style>
    body{
      background: url('{{asset("img/bg.jpg")}}');
      background-repeat: no-repeat;
      background-size: 100%;
      position: relative;
      background-attachment: fixed;
    }
  </style>
</head>
<body>
  <div id="app">
    <index></index>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>