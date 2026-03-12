@extends('layouts.app')

@section('content')
<style>
    .active-category {
        background-color: #f8f9fa;

        padding-left: 10px;
        font-weight: bold;
    }

    /* FORCE pagination horizontal */
    .shop-pagination .pagination {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 8px;
    }

    /* Fix page items */
    .shop-pagination .page-item {
        float: none !important;
    }

    /* Fix buttons */
    .shop-pagination .page-link {
        min-width: 40px;
        height: 40px;
        line-height: 26px;
        text-align: center;
        border-radius: 6px;
    }

    .page-header {
        position: relative;
        padding: 100px 0;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(../img/carousel-1.jpg);
        background-position: center top;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .category-scroll {
        max-height: 300px;
        /* adjust height */
        overflow-y: auto;
        padding-right: 5px;
    }

    .category-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .category-scroll::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
</style>

    <!-- #region -->


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Shop Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Searvices Start -->

    <!-- Searvices End -->


    <!-- Products Offer Start -->

    <!-- Products Offer End -->


    <!-- Shop Page Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-categories mb-4">
                        <h4>Products Categories</h4>

                        <ul class="list-unstyled category-scroll">
                            @foreach ($cat as $cats)
                                                    <li>
                                                        <div class="categories-item 
                                                                    {{ request('category') == $cats->slug ||
                                (!request('category') && $cats->slug == 'accessories')
                                ? 'active-category' : '' }}">

                                                            <a href="{{ route('shop', ['category' => $cats->slug]) }}"
                                                                class="text-dark d-flex justify-content-between align-items-center">

                                                                <span>
                                                                    <i class="fas fa-apple-alt text-secondary me-2"></i>
                                                                    {{ $cats->slug }}
                                                                </span>

                                                                <span>({{ $cats->products_count }})</span>
                                                            </a>

                                                        </div>
                                                    </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="price mb-4">
                        <h4 class="mb-2">Price</h4>

                        <input type="range" class="form-range w-100 rangeInput" id="rangeInput" min="{{ $minPrice }}"
                            max="{{ $maxPrice }}" value="{{ request('max_price', $maxPrice) }}">

                        <div class="d-flex justify-content-between">
                            <span>₹{{ $minPrice }}</span>
                            <span>₹<span id="amount">
                                    {{ request('max_price', $maxPrice) }}
                                </span></span>
                        </div>
                    </div>

                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Featured products</h4>

                        @foreach ($featuredProducts as $product)
                            @if ($product->is_featured == 1)


                                <div class="featured-product-item">

                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid rounded"
                                            alt="Image">
                                    </div>
                                    <div>
                                        <h6 class="mb-2"> {{ $product->name }}</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">{{ $product->price }}</h5>
                                            <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach

                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn btn-primary px-4 py-3 rounded-pill w-100">View More</a>
                        </div>

                    </div>

                </div>
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="rounded mb-4 position-relative">
                        <img src="img/product-banner-3.jpg" class="img-fluid rounded w-100" style="height: 250px;"
                            alt="Image">
                        <div class="position-absolute rounded d-flex flex-column align-items-center justify-content-center text-center"
                            style="width: 100%; height: 250px; top: 0; left: 0; background: rgba(242, 139, 0, 0.3);">
                            <h4 class="display-5 text-primary">SALE</h4>
                            <h3 class="display-4 text-white mb-4">Get UP To 50% Off</h3>
                            <a href="#" class="btn btn-primary rounded-pill">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-xl-7">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1" id="keyword">
                                <span id="search-icon-1" class="input-group-text p-3 "><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-3 text-end">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                                <label for="electronics">Sort By:</label>
                                <select id="electronics" name="electronicslist"
                                    class="border-0 form-select-sm bg-light me-3 sortBy " form="electronicsform">
                                    <option value="volvo">Default Sorting</option>

                                    <option value="low_to_high">Low to high</option>
                                    <option value="high_to_low">High to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-2">
                            <ul class="nav nav-pills d-inline-flex text-center py-2 px-2 rounded bg-light mb-4">
                                <li class="nav-item me-4">
                                    <a class="bg-light" data-bs-toggle="pill" href="#tab-5">
                                        <i class="fas fa-th fa-3x text-primary"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="bg-light" data-bs-toggle="pill" href="#tab-6">
                                        <i class="fas fa-bars fa-3x text-primary"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4 product product-list">
                                @forelse ($products as $product)

                                <div class="col-lg-4">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">

                                                <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                                <div class="product-new">New</div>
                                                <div class="product-details">
                                                    <a href="{{ route('Cartview', ['product' => $product->id]) }}">
                                                        <i class="fa fa-eye fa-1x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#" class="d-block mb-2">{{ $product->name }}</a>
                                                <a href="#" class="d-block h4">{{ $product->description }}</a>
                                                <del class="me-2 fs-5">$1,250.00</del>
                                                <span class="text-primary fs-5">{{ $product->price }}</span>
                                            </div>
                                        </div>
                                        <div
                                            class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">

                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf

                                                <input type="hidden" id="product_id" name="product_id"
                                                    value="{{ $product->id }}">
                                                <button
                                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4   addToCart"
                                                    data-id="{{ $product->id }}"><i
                                                        class="fas fa-shopping-cart me-2"></i>
                                                    Add To
                                                    Cart</button>
                                            </form>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star text-primary"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                            class="rounded-circle btn-sm-square border"><i
                                                                class="fas fa-random"></i></i></a>
                                                    <a href="#"
                                                        class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                            class="rounded-circle btn-sm-square border"><i
                                                                class="fas fa-heart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info mb-0">No products found.</div>
                                    </div>
                                @endforelse
                                <div class="shop-pagination text-center mt-5">
                                    {{ $products->withQueryString()->links() }}
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End -->

    <!-- Product Banner Start -->

    <!-- Product Banner End -->


    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection
@section('scripts')

    <!-- JavaScript Libraries -->
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 3000);
    </script>
<script>

    $(document).on('click', '.addToCart', function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        //  alert("clicked");

        // alert("Clicked Product ID: " + prod_id);
        $.ajax({
            url: "{{ route('cart.addto') }}",
            type: "POST",
            data: {
                product_id: product_id,
                _token: "{{ csrf_token() }}"
            },

            success: function (response) {

                // ✅ Update cart count
                $('#cart-count').text(response.cart_count);
                // console.log(response.count);

                // ✅ Show notification
                showNotification(response.message);

            },
            error: function () {
                showNotification("Something went wrong!");
            }
        });



    });



</script>
<script>
    $(document).on('input', '#rangeInput', function () {
        $('#amount').text($(this).val());
    });

    $(document).on('change', '#rangeInput', function () {
        loadProducts();
    });
</script>
<script>
    $(document).on('change', '.sortBy', function () {
        loadProducts();
    });
</script>
</script>
<script>

    let delayTimer;

    $(document).on('keyup', '#keyword', function () {

        clearTimeout(delayTimer);

        delayTimer = setTimeout(function () {
            loadProducts();   // 🔥 call main filter function
        }, 300);  // 300ms delay (professional debounce)

    });
</script>

<script>
    function showNotification(message) {

        let notification = `
        <div id="cart-alert"
             style="position:fixed; top:20px; right:20px; 
                    background:#28a745; color:white; 
                    padding:10px 20px; border-radius:5px;
                    z-index:9999;">
            ${message}
        </div>
    `;

        $('body').append(notification);

        setTimeout(function () {
            $('#cart-alert').fadeOut(500, function () {
                $(this).remove();
            });
        }, 2000);
    }
</script>
<script>
    function loadProducts() {

        $.ajax({
            url: "{{ route('shop') }}",
            type: "GET",
            data: {
                category: "{{ request('category') ?? 'accessories' }}",
                keyword: $('#keyword').val(),
                max_price: $('#rangeInput').val(),
                sort: $('.sortBy').val()
            },
            success: function (response) {

                let html = '';

                response.products.forEach(function (product) {
                    html += `
                <div class="col-lg-4">
                    <div class="product-item rounded">
                        <div class="product-item-inner border rounded">
                            <img src="/uploads/products/${product.image}" class="img-fluid w-100 rounded-top">
                            <div class="text-center p-3">
                                <h5>${product.name}</h5>
                                <span class="text-primary">₹${product.price}</span>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                });

                $('.product-list').html(html);
                $('.shop-pagination').html(response.pagination);
            }
        });


    }
</script>


@endsection
