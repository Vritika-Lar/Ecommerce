@extends('layouts.app')
@section('title', 'single')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Single Products Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">

                <div class="col-lg-7 col-xl-10 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-6 single-product">
                        <div class="col-xl-6">
                            <div id="cart-section">

                                @if($product)
                                    <div class="single-item">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                            class="img-fluid w-100 rounded single-product-img" alt="{{ $product->name }}">

                                    </div>

                                @endif

                            </div>





                        </div>
                        <div class="col-xl-6">
                            @if ($product)


                                <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                                <p class="mb-3"></p>
                            @endif
                            <h5 class="fw-bold mb-3"></h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <small>Product SKU: N/A</small>
                                <small>Available: <strong class="text-primary">20 items in stock</strong></small>
                            </div>
                            <p class="mb-4">The generated Lorem Ipsum is therefore always free from repetition injected
                                humour, or non-characteristic words etc.</p>
                            <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder;
                                chain pickerel hatchetfish, pencilfish snailfish</p>

                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                @csrf

                                <input type="hidden" class="product_id" name="product_id" value="{{ $product->id }}">

                                <div class="input-group mb-4" style="width: 120px;">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <input type="text" name="quantity"
                                        class="form-control form-control-sm text-center border-0 quantity-input" value="1">

                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                                <button type="submit" class="btn btn-primary rounded-pill addToCart">
                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                </button>

                            </form>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                @if ($product)


                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        {{ $product->description }}
                                    </div>
                                @endif
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Jason Smith</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>The generated Lorem Ipsum is therefore always free from repetition
                                                injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Sam Peters</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">The generated Lorem Ipsum is therefore always free from
                                                repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Single Products End -->

    <!-- Related Product Start -->

    <!-- Related Product End -->


    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>


@endsection

@section('scripts')
    <script>
        $(document).on('submit', '.add-to-cart-form', function (e) {

            e.preventDefault();

            let form = $(this);

            let product_id = form.find('.product_id').val();
            let quantity = form.find('.quantity-input').val();

            $.ajax({
                url: form.attr('action'),
                type: "POST",
                data: {
                    product_id: product_id,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    $('#cart-count').text(response.cart_count);

                    showNotification(response.message);
                },
                error: function () {
                    showNotification("Something went wrong!");
                }
            });

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
        // Increase quantity
        $(document).on('click', '.btn-plus', function () {
            let input = $(this).closest('.input-group').find('.quantity-input');
            let currentValue = parseInt(input.val(), 10) || 1;
            input.val(currentValue + 1);
        });

        // Decrease quantity
        $(document).on('click', '.btn-minus', function () {
            let input = $(this).closest('.input-group').find('.quantity-input');
            let currentValue = parseInt(input.val(), 10) || 1;
            if (currentValue > 1) {
                input.val(currentValue - 1);
            }
        });
    </script>
@endsection