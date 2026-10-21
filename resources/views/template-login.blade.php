<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstarp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand img {
            height: 40px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="BimShop" style="width: 77px; height: 77px">
            </a>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
<script src="{{ asset('bootstarp/js/bootstrap.bundle.min.js') }}"></script>


