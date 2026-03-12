<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #165289;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #2f6397;
        }

        img.h-16.w-auto {
            height: 87px;

            margin-top: 24px;
        }
    </style>
</head>

<body>
    <div class="row g-0">
        <div class="col-md-2 sidebar">
            <div class="text-center">
                <img src="{{ asset('assets/site/images/logo.png') }}" alt="Logo" class="h-16 w-auto" />
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="btn text-light {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('categories.index') }}"
                class="btn text-light {{ request()->routeIs('categories.index') || request()->routeIs('categories.edit') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.products.index') }}"
                class="btn text-light {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.edit') ? 'active' : '' }}">Products</a>
            <a href="{{ route('admin.orders.index') }}"
                class="btn text-light {{ request()->routeIs('admin.orders.index') || request()->routeIs('admin.orders.show') ? 'active' : '' }}">Orders</a>
            <a href="{{ route('admin.newsletters.index') }}"
                class="btn text-light {{ request()->routeIs('admin.newsletters.index') ? 'active' : '' }}">Newsletter</a>
            <a href="{{ route('admin.contacts.index') }}"
                class="btn text-light {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">Contacts</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100 mt-3">Logout</button>
            </form>
        </div>

        <div class="col-md-10 p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
