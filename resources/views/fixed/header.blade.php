<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=@yield('description')>
    <meta name="keywords" content=@yield('keywords')>
    <meta name="author" content="Aleksandra Markovic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/jewelry.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
{{--    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">--}}


    <title>Jewelry Store | @yield('title')</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- TEMPLATE -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <!-- TEMPLATE END -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
