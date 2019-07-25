<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
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
        @include('layouts.menu')
        <router-view></router-view>
    </div> <!-- app -->    
    <script src=/js/app.js></script>
</body>
</html>