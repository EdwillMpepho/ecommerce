<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edwill Trucks</title>
    <!-- bootstrap stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- custome style -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- stripe js -->
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
   @include('navbar.nav')
   <div class="container">
    @include('message.messages')
     @yield('content')
   </div>
   <!-- stripe custom js file -->
    <script src="{{ asset('js/my-stripe.js') }}"></script>
    <!-- jquery js -->
    <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
    <!-- bootstrap js -->
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>
