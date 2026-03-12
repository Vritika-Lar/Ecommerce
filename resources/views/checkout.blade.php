@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', auth()->user()->name ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state') }}"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Country</label>
                                    <select class="form-select" name="country" required>
                                        @php
                                            $countries = [
                                                'IN' => 'India',
                                                'US' => 'United States',
                                                'CA' => 'Canada',
                                                'GB' => 'United Kingdom',
                                                'AU' => 'Australia',
                                                'AE' => 'United Arab Emirates',
                                                'SG' => 'Singapore',
                                                'DE' => 'Germany',
                                                'FR' => 'France',
                                                'NL' => 'Netherlands',
                                                'JP' => 'Japan',
                                            ];
                                            $selectedCountry = old('country', 'IN');
                                        @endphp
                                        @foreach ($countries as $code => $label)
                                            <option value="{{ $code }}" @selected($selectedCountry === $code)>{{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-select" name="payment_method" id="payment-method" required>
                                        <option value="cod" @selected(old('payment_method') === 'cod')>Cash on Delivery
                                        </option>
                                        <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>
                                            Bank Transfer</option>
                                        <option value="stripe" @selected(old('payment_method') === 'stripe')>Stripe Card
                                            Payment</option>
                                    </select>
                                </div>
                                <div class="col-12 d-none" id="stripe-payment-section">
                                    <label class="form-label">Card Details</label>
                                    <div id="card-element" class="form-control py-2"></div>
                                    <input type="hidden" name="stripeToken" id="stripe-token">
                                    <div id="card-errors" class="text-danger small mt-2"></div>
                                    @error('stripe')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                    @error('stripeToken')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-4" type="submit">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">Order Summary</div>
                    <div class="card-body">
                        @foreach ($cart as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tax (5%)</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        (function () {
            const form = document.getElementById('checkout-form');
            const paymentSelect = document.getElementById('payment-method');
            const stripeSection = document.getElementById('stripe-payment-section');
            const stripeTokenInput = document.getElementById('stripe-token');
            const errorEl = document.getElementById('card-errors');

            const stripeKey = "{{ config('services.stripe.key') }}";
            const stripe = stripeKey ? Stripe(stripeKey) : null;
            const elements = stripe ? stripe.elements() : null;
            const card = elements ? elements.create('card') : null;

            if (card) {
                card.mount('#card-element');
                card.on('change', function (event) {
                    errorEl.textContent = event.error ? event.error.message : '';
                });
            }

            function toggleStripeSection() {
                const useStripe = paymentSelect.value === 'stripe';
                stripeSection.classList.toggle('d-none', !useStripe);
            }

            toggleStripeSection();
            paymentSelect.addEventListener('change', toggleStripeSection);

            form.addEventListener('submit', async function (e) {
                if (paymentSelect.value !== 'stripe') {
                    return;
                }

                if (!stripe || !card) {
                    e.preventDefault();
                    errorEl.textContent = 'Stripe is not configured. Please contact support.';
                    return;
                }

                e.preventDefault();
                const billingDetails = {
                    name: document.querySelector('input[name="name"]')?.value || '',
                    address_line1: document.querySelector('input[name="address"]')?.value || '',
                    address_city: document.querySelector('input[name="city"]')?.value || '',
                    address_state: document.querySelector('input[name="state"]')?.value || '',
                    address_zip: document.querySelector('input[name="zip_code"]')?.value || '',
                    address_country: document.querySelector('input[name="country"]')?.value || '',
                };

                const { token, error } = await stripe.createToken(card, billingDetails);

                if (error) {
                    errorEl.textContent = error.message;
                    return;
                }

                stripeTokenInput.value = token.id;
                form.submit();
            });
        })();
    </script>
@endsection
