<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">

        <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                        style="width: 70px; height: 70px;">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <h4 class="text-white">Address</h4>
                    <p>123 Street New York, USA</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                        style="width: 70px; height: 70px;">
                        <i class="fas fa-envelope fa-2x text-primary"></i>
                    </div>
                    <h4 class="text-white">Mail Us</h4>
                    <p>info@example.com</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                        style="width: 70px; height: 70px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <h4 class="text-white">Telephone</h4>
                    <p>(+012) 3456 7890</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                        style="width: 70px; height: 70px;">
                        <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                    </div>
                    <h4 class="text-white">Website</h4>
                    <p>yoursite@example.com</p>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-6 col-lg-3">
                <h4 class="text-primary mb-4">Newsletter</h4>
                <p class="text-white">Subscribe to get latest updates.</p>
                @if (session('newsletter_success'))
                    <div class="alert alert-success py-2">{{ session('newsletter_success') }}</div>
                @endif
                <form method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <div class="position-relative">
                        <input class="form-control rounded-pill py-3 ps-4 pe-5" type="email" name="newsletter_email"
                            value="{{ old('newsletter_email') }}" placeholder="Email" required>
                        <button type="submit"
                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">
                            Sign Up
                        </button>
                    </div>
                    @error('newsletter_email')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <div class="col-md-6 col-lg-3">
                <h4 class="text-primary mb-4">Customer Service</h4>
                <a href="#" class="d-block text-white mb-2">Contact Us</a>
                <a href="#" class="d-block text-white mb-2">Returns</a>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.orders.index') }}" class="d-block text-white mb-2">Order History</a>
                    @else
                        <a href="{{ route('orders.history') }}" class="d-block text-white mb-2">Order History</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="d-block text-white mb-2">Order History</a>
                @endauth
            </div>

            <div class="col-md-6 col-lg-3">
                <h4 class="text-primary mb-4">Information</h4>
                <a href="#" class="d-block text-white mb-2">About Us</a>
                <a href="#" class="d-block text-white mb-2">Privacy Policy</a>
                <a href="#" class="d-block text-white mb-2">Terms & Conditions</a>
            </div>

            <div class="col-md-6 col-lg-3">
                <h4 class="text-primary mb-4">Extras</h4>
                <a href="#" class="d-block text-white mb-2">Brands</a>
                <a href="#" class="d-block text-white mb-2">Gift Vouchers</a>
                <a href="#" class="d-block text-white mb-2">Wishlist</a>
            </div>
        </div>

    </div>
</div>
<!-- Footer End -->

<!-- Copyright -->
<div class="container-fluid copyright py-4 bg-dark">
    <div class="container d-flex justify-content-between text-white">
        <span>© Your Site Name. All rights reserved.</span>
        <span>Designed by HTML Codex</span>
    </div>
</div>
