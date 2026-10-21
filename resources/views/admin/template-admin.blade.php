<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin BimShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstarp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">


    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            position: fixed;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar d-none d-md-block">
            <div class="py-4 text-center">
                <h4 class="text-white">BimShop Admin</h4>
            </div>
                         <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/member">Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/produk">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/category">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.invoices') }}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/promo">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">Logout</a>
                        </li>
                    </ul>
        </nav>

        <main class="col-md-10 ms-sm-auto px-4 py-4">
            <h2 class="mb-4">@yield('title')</h2>
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset('bootstarp/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
