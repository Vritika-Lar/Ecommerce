<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Electro - Electronics Website')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS (ONLY ONE) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="{{ asset('lib/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <!-- Animate -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')
    <style>
        body {
            margin: 0;
            font-family: "Open Sans", sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #919191;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .nav-bar .navbar .navbar-nav .nav-link {
            padding: 18px 15px;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            font-size: 17px;
            transition: .5s;
        }

        .navbar-light .navbar-nav .nav-link {
            color: rgba(0, 0, 0, .55);
        }

        .navbar .navbar-nav .nav-link:hover,
        .navbar .navbar-nav .nav-link.active,
        .fixed-top.bg-white .navbar .navbar-nav .nav-link:hover,
        .fixed-top.bg-white .navbar .navbar-nav .nav-link.active {
            color: var(--bs-white);
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: var(--bs-primary) !important;
        }

        .nav-bar {
            position: sticky;
            top: 0;
            z-index: 994;
        }

        i.fa.fa-shopping-cart.fa-2x {
            color: rgba(0, 0, 0, .55);
            ;
        }

        i.fa.fa-shopping-cart.fa-2x:hover {
            color: var(--bs-white);
        }

        #search-results {
            background: #fff;
            border-radius: 10px;
            z-index: 9999;
            max-height: 300px;
            overflow-y: auto;
        }

        .navbar-nav .nav-link {
            padding: 8px 14px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link.active {

            /* shaded box */
            color: #000;
            /* text color */
            border: 1px solid rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }


        .navbar-nav .nav-link {
            margin: 0 5px;
        }
    </style>
</head>

<body>

    {{-- ================= TOPBAR ================= --}}
    <div class="container-fluid px-5 d-none border-bottom d-lg-block ">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-4 text-center text-lg-start mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#" class="text-muted me-2"> Help</a><small> / </small>
                    <a href="#" class="text-muted mx-2"> Support</a><small> / </small>
                    <a href="#" class="text-muted ms-2"> Contact</a>
                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
                <small class="text-dark">Call Us:</small>
                <a href="#" class="text-muted">(+012) 1234 567890</a>
            </div>

            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-muted me-2" data-bs-toggle="dropdown"><small>
                                USD</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"> Euro</a>
                            <a href="#" class="dropdown-item"> Dolar</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-muted mx-2" data-bs-toggle="dropdown"><small>
                                English</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"> English</a>
                            <a href="#" class="dropdown-item"> Turkish</a>
                            <a href="#" class="dropdown-item"> Spanol</a>
                            <a href="#" class="dropdown-item"> Italiano</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        @guest
                            <a href="#" class="text-muted ms-2" data-bs-toggle="modal" data-bs-target="#authModal">
                                <small><i class="fa fa-user me-2"></i>Login </small>
                            </a>

                        @endguest
                        @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    My Dashboard
                                </a>
                                <div class="dropdown-menu m-0">
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                                        <a href="{{ route('admin.orders.index') }}" class="dropdown-item">Order History</a>
                                    @else
                                        <a href="{{ route('user.dashboard') }}" class="dropdown-item">My Dashboard</a>
                                        <a href="{{ route('orders.history') }}" class="dropdown-item">Order History</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid px-5 py-4 d-none d-lg-block">
        <div class="row gx-0 align-items-center text-center">
            <div class="col-md-4 col-lg-3 text-center text-lg-start">
                <div class="d-inline-flex align-items-center">
                    <a href="{{ route('homepage.index') }}" class="navbar-brand p-0">
                        <h1 class="display-5 text-primary m-0"><i
                                class="fas fa-shopping-bag text-secondary me-2"></i>Electro</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-6 text-center">
                <div class="position-relative ps-4 sti">
                    <form class="d-flex border rounded-pill" method="GET" action="{{ route('shop') }}">
                        <input class="form-control border-0 rounded-pill w-100 py-3" type="text" id="live-search"
                            name="keyword" value="{{ request('keyword') }}" placeholder="Search Looking For?">
                        <select class="form-select text-dark border-0 border-start rounded-0 p-3" id="category-select"
                            name="category" style="width: 200px;">
                            <option value="all" @selected(!request('category') || request('category') === 'all')>All
                                Categories</option>
                            @foreach ($layoutCategories as $category)
                                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                                class="fas fa-search"></i></button>
                    </form>
                    <!-- Live Search Result -->
                    <div id="search-results" class="list-group position-absolute w-100"></div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-random"></i></i></a>
                    <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-heart"></i></a>


                </div>
            </div>
        </div>
    </div>
    {{-- ================= NAVBAR ================= --}}
    <div class="container-fluid nav-bar p-0">
        <div class="row gx-0 bg-primary px-5 align-items-center">
            <div class="col-lg-3 d-none d-lg-block">
                <nav class="navbar navbar-light position-relative" style="width: 250px;">
                 
                 
                </nav>
            </div>
            <div class="col-12 col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                    <a href="" class="navbar-brand d-block d-lg-none">
                        <h1 class="display-5 text-secondary m-0"><i
                                class="fas fa-shopping-bag text-white me-2"></i>Electro</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars fa-1x"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">

                            <a href="{{ route('index.home') }}"
                                class="nav-item nav-link {{ request()->routeIs('index.home') ? 'active' : '' }}">
                                Home
                            </a>

                            <a href="{{ route('shop') }}"
                                class="nav-item nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">
                                Shop
                            </a>

                            <a href="{{ route('contact') }}"
                                class="nav-item nav-link me-2 {{ request()->routeIs('contact') ? 'active' : '' }}">
                                Contact
                            </a>

                            <div class="nav-item dropdown d-block d-lg-none mb-3">
                                <a href="#" class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                                    data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle">All Category</span>
                                </a>

                                <div class="dropdown-menu m-0">
                                    <ul class="list-unstyled categories-bars">
                                        @foreach ($layoutCategories as $category)
                                            <li>
                                                <div class="categories-bars-item">
                                                    <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <a href="{{ route('cart') }}" class="position-relative">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                            <span id="cart-count"
                                class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                                {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}

                            </span>

                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{-- ================= MAIN CONTENT ================= --}}
    <main class="container-fluid lg">
        @yield('content')
    </main>

    {{-- ================= AUTH MODAL ================= --}}
    @guest
        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="authModalLabel">Welcome</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs mb-3" id="authTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                    data-bs-target="#login-tab-pane" type="button" role="tab"
                                    aria-controls="login-tab-pane" aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab"
                                    data-bs-target="#register-tab-pane" type="button" role="tab"
                                    aria-controls="register-tab-pane" aria-selected="false">Register</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="authTabsContent">
                            <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel"
                                aria-labelledby="login-tab">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <input type="hidden" name="redirect_to" id="login-redirect-to" value="">
                                    <div class="mb-3">
                                        <label for="login-email" class="form-label">Email</label>
                                        <input id="login-email" type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" required autofocus autocomplete="username">
                                        @if (!old('name'))
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="login-password" class="form-label">Password</label>
                                        <input id="login-password" type="password" name="password" class="form-control"
                                            required autocomplete="current-password">
                                        @if (!old('name'))
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                name="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                                Forgot password?
                                            </a>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="register-tab-pane" role="tabpanel"
                                aria-labelledby="register-tab">
                                @php
                                    $registerContext = old('name') || $errors->has('name') || $errors->has('password_confirmation');
                                @endphp
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input type="hidden" name="redirect_to" id="register-redirect-to" value="">
                                    <div class="mb-3">
                                        <label for="register-name" class="form-label">Name</label>
                                        <input id="register-name" type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" required autocomplete="name">
                                        @if ($registerContext)
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="register-email" class="form-label">Email</label>
                                        <input id="register-email" type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" required autocomplete="username">
                                        @if ($registerContext)
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="register-password" class="form-label">Password</label>
                                        <input id="register-password" type="password" name="password"
                                            class="form-control" required autocomplete="new-password">
                                        @if ($registerContext)
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="register-password-confirmation" class="form-label">Confirm
                                            Password</label>
                                        <input id="register-password-confirmation" type="password"
                                            name="password_confirmation" class="form-control" required
                                            autocomplete="new-password">
                                        @if ($registerContext)
                                            @error('password_confirmation')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5">
                <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="rounded p-4">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-white">Address</h4>
                                <p class="mb-2">123 Street New York.USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="rounded p-4">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                style="width: 70px; height: 70px;">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-white">Mail Us</h4>
                                <p class="mb-2">Electro@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="rounded p-4">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                style="width: 70px; height: 70px;">
                                <i class="fa fa-phone-alt fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-white">Telephone</h4>
                                <p class="mb-2">(+012) 3456 7890</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="rounded p-4">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                style="width: 70px; height: 70px;">
                                <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-white">e@ex.com</h4>
                                <p class="mb-2">(+012) 3456 7890</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <div class="footer-item">
                                <h4 class="text-primary mb-4">Newsletter</h4>
                                <p class="text-white mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem
                                    ipsum
                                    dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
                                @if (session('newsletter_success'))
                                    <div class="alert alert-success py-2">{{ session('newsletter_success') }}</div>
                                @endif
                                <form method="POST" action="{{ route('newsletter.subscribe') }}">
                                    @csrf
                                    <div class="position-relative mx-auto rounded-pill">
                                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="email"
                                            name="newsletter_email" value="{{ old('newsletter_email') }}"
                                            placeholder="Enter your email" required>
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">
                                            SignUp
                                        </button>
                                    </div>
                                    @error('newsletter_email')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-primary mb-4">Customer Service</h4>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Returns</a>
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.orders.index') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @else
                                    <a href="{{ route('orders.history') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class=""><i class="fas fa-angle-right me-2"></i> Order
                                    History</a>
                            @endauth
                            @auth
                                @if (auth()->user()->role === 'user')
                                    <a href="{{ route('user.orders.index') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @else
                                    <a href="{{ route('orders.history') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class=""><i class="fas fa-angle-right me-2"></i> Order
                                    History</a>
                            @endauth
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Site Map</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Testimonials</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> My Account</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Unsubscribe Notification</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-primary mb-4">Information</h4>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> About Us</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Delivery infomation</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Warranty</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> FAQ</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Seller Login</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-primary mb-4">Extras</h4>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Brands</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Gift Vouchers</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Affiliates</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Wishlist</a>
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.orders.index') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @else
                                    <a href="{{ route('orders.history') }}" class=""><i class="fas fa-angle-right me-2"></i>
                                        Order History</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class=""><i class="fas fa-angle-right me-2"></i> Order
                                    History</a>
                            @endauth
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                            <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->



    </footer>

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white">

                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a>.
                    Distributed By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    {{-- ================= SCRIPTS ================= --}}

    <!-- Bootstrap JS (ONLY ONE) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: { items: 1 },
                    768: { items: 1 },
                    992: { items: 1 }
                }
            });
        });
    </script>

    @yield('scripts')

    @guest
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
                if (!hasErrors) return;

                const authModalEl = document.getElementById('authModal');
                if (!authModalEl) return;

                const authModal = new bootstrap.Modal(authModalEl);
                authModal.show();

                const openRegister = {{ ($errors->has('name') || $errors->has('password_confirmation')) ? 'true' : 'false' }};
                if (openRegister) {
                    const registerTab = document.getElementById('register-tab');
                    if (registerTab) {
                        const tab = new bootstrap.Tab(registerTab);
                        tab.show();
                    }
                }
            });
        </script>
    @endguest

</body>


<script>

    $(document).ready(function () {

        $('#live-search').on('keyup', function () {

            let keyword = $(this).val();
            let selectedCategory = $('#category-select').val();

            if (keyword.length < 2) {
                $('#search-results').html('');
                return;
            }

            $.ajax({
                url: "{{ route('live.search') }}",
                type: "GET",
                data: { keyword: keyword, category: selectedCategory },


                success: function (data) {

                    let html = '';

                    data.forEach(function (product) {

                        let categorySlug = selectedCategory;
                        if (!categorySlug || categorySlug === 'all') {
                            categorySlug = product.category ? product.category.slug : '';
                        }

                        const params = new URLSearchParams();
                        if (categorySlug) {
                            params.set('category', categorySlug);
                        }
                        if (keyword) {
                            params.set('keyword', keyword);
                        }

                        let url = "{{ route('shop') }}";
                        const queryString = params.toString();
                        if (queryString) {
                            url += `?${queryString}`;
                        }

                        html += `
                    <a href="${url}" class="list-group-item list-group-item-action">
                        ${product.name}
                    </a>`;
                    });

                    $('#search-results').html(html);
                }

            });

        });

    });
</script>


</html>
