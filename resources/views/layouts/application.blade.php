<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Custom styles for this template -->
        
        <link rel="stylesheet" href="{{asset('bootstrap4\dist\css\bootstrap.css')}}">
        <script src="{{asset('bootstrap4\assets\js\vendor\jquery-slim.min.js')}}"></script>
        <script src="{{asset('bootstrap4\assets\js\vendor\popper.min.js')}}"></script>
        <script src="{{asset('bootstrap4\dist\js\bootstrap.min.js')}}"></script>

    </head>

    <body  style="background-color: #e9ecef">
        @include('inc.header')
        @include('inc.navbar')
        <div class="container-fluid pb-5">
            @include('inc.messages')
            @yield('content')
        </div>

    </body>

</html>