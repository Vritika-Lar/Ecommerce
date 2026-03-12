@extends('layouts.app')
@section('title', 'home')
@section('content')
    <!-- Carousel Start -->


    <style>
        .owl-carousel {
            display: block;
            width: 100%;
            z-index: 1;
        }
    </style>

    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="header-carousel owl-carousel bg-light py-5">
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('img/carousel-1.png') }}" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A $400</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="{{ route('shop') }}">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('img/carousel-2.png') }}" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A $200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="{{ route('shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner h-100">
                    <img src="img/header-img.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Image">
                    <div class="carousel-banner-offer">
                        <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Save $48.00</p>
                        <p class="text-primary fs-5 fw-bold mb-0">Special Offer</p>
                    </div>
                    <div class="carousel-banner">
                        <div class="carousel-banner-content text-center p-4">
                            <a href="#" class="d-block mb-2">SmartPhone</a>
                            <a href="#" class="d-block text-white fs-3">Apple iPad Mini <br> G2356</a>
                            <del class="me-2 text-white fs-5">$1,250.00</del>
                            <span class="text-primary fs-5">$1,050.00</span>
                        </div>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4"><i class="fas fa-shopping-cart me-2"></i>
                            Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel End -->

    <!-- Searvices Start -->

    <!-- Searvices End -->

    <!-- Products Offer Start -->

    <!-- Products Offer End -->


    <!-- Our Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Our Products</h1>
                    </div>

                    
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($products as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
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
                                                <a href="#" class="d-block mb-2">{{$product->name}}</a>
                                                <a href="#" class="d-block h4">{{$product->description}} <br> </a>
                                                <del class="me-2 fs-5">$1,250.00</del>
                                                <span class="text-primary fs-5">{{ $product->price }}</span>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf

                                                <input type="hidden" id="product_id" name="product_id"
                                                    value="{{ $product->id }}">
                                                <button
                                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4   addToCart"
                                                    data-id="{{ $product->id }}"><i class="fas fa-shopping-cart me-2"></i>
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
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-3.png" class="img-fluid rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-4.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-5.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-6.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-9.png" class="img-fluid w-100 rounded-top" alt="">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-10.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-11.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-12.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-14.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-15.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-17.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-16.png" class="img-fluid w-100 rounded-top" alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Products End -->

    <!-- Product Banner Start -->

    <!-- Product Banner End -->

    <!-- Product List Satrt -->

    <!-- Product List End -->

    <!-- Bestseller Products Start -->

    <!-- Bestseller Products End -->


    <!-- Footer Start -->

    <!-- Footer End -->



    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.addToCart', function (e) {
            e.preventDefault();
            var product_id = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.addto') }}",
                type: "POST",
                data: {
                    product_id: product_id,
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
@endsection