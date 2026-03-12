@extends('layouts.app')

@section('content')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Cart Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart Page</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">



        <div class="container py-5">
            @if (count(session('cart', [])) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>

                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart', []) as $id => $details)
                                <tr>
                                    <th scope="row">
                                        <p class="mb-0 py-4">{{ $details['name'] ?? '' }}</p>
                                    </th>

                                    <td>
                                        <p class="mb-0 py-4">{{ $details['price'] ?? 0 }}</p>
                                    </td>

                                    <td>
                                        <div class="input-group quantity py-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border btn-minus"
                                                    data-id="{{ $id }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>

                                            <input type="text"
                                                class="form-control form-control-sm text-center border-0 qty-input"
                                                value="{{ $details['quantity'] ?? 1 }}">

                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border btn-plus"
                                                    data-id="{{ $id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="mb-0 py-4  item-total">
                                            {{ ($details['price'] ?? 0) * ($details['quantity'] ?? 1) }} $
                                        </p>
                                    </td>

                                    <td class="py-4">
                                        <button type="button" class="btn btn-md rounded-circle bg-light border removeItem"
                                            data-id="{{ $id }}">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">$ <span id="sub-total">
                                        {{ collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['quantity']) }}
                                    </span></p>
                            </div>
                    
                           
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">$<span id="actual-total">
                                    {{ collect(session('cart', []))->sum(fn($item) => $item['price'] * $item['quantity']) }}
                                </span></p>

                        </div>
                        @auth
                            <a href="{{ route('checkout') }}"
                                class="btn btn-primary rounded-pill px-4 py-3 text-uppercase mb-4 ms-4">
                                Proceed Checkout
                            </a>
                        @else
                            <button class="btn btn-primary rounded-pill px-4 py-3 text-uppercase mb-4 ms-4 js-checkout-login"
                                type="button" data-bs-toggle="modal" data-bs-target="#authModal"
                                data-redirect="{{ route('checkout') }}">
                                Proceed Checkout
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
            @else
                <div class="text-center py-5">
                    <h4 class="mb-3">Your cart is empty.</h4>
                    <p class="text-muted mb-4">No items have been added to your cart yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4 py-3 text-uppercase">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>

    </div>
    <!-- Cart Page End -->



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
        $(document).on('click', '.removeItem', function (e) {

            e.preventDefault();
            let product_id = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.remove') }}",
                type: "POST",
                data: {
                    product_id: product_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    $('#cart-count').text(response.count);

                    showNotification(response.message);
                    location.reload();
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-plus', function () {

            var product_id = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.quantity') }}",
                type: "POST",
                data: {
                    product_id: product_id,
                    action: "increase",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    var row = $('button[data-id="' + product_id + '"]').closest('tr');

                    $('#cart-count').text(response.cart_count);
                    $('#sub-total').text(response.sub_total);
                    $('#actual-total').text(response.actual_total);

                    row.find('.qty-input').val(response.new_quantity);
                    row.find('.item-total').text(response.item_total + ' $');

                    showNotification(response.message);
                }
            });

        });
    </script>
    <script>
        $(document).on('click', '.btn-minus', function () {

            var product_id = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.quantity') }}",
                type: "POST",
                data: {
                    product_id: product_id,
                    action: "decrease",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    var row = $('button[data-id="' + product_id + '"]').closest('tr');

                    $('#cart-count').text(response.cart_count);
                    $('#sub-total').text(response.sub_total);
                    $('#actual-total').text(response.actual_total);

                    if (response.new_quantity > 0) {
                        row.find('.qty-input').val(response.new_quantity);
                        row.find('.item-total').text(response.item_total + ' $');
                    } else {
                        row.remove();
                    }

                    showNotification(response.message);
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
        $(document).on('click', '.js-checkout-login', function () {
            const redirectTo = $(this).data('redirect') || '';
            $('#login-redirect-to').val(redirectTo);
            $('#register-redirect-to').val(redirectTo);
        });
    </script>

@endsection
