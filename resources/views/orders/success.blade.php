@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg border-0 rounded-4 p-4">

                    <h2 class="fw-bold mb-3">
                        Order confirmation 🛍
                    </h2>

                    <p>
                        Hi <strong>{{ $order->user->name }}</strong>,
                    </p>

                    <p>
                        Thank you for shopping with us! We've received your order
                        <strong>#{{ $order->id }}</strong>.
                        We will notify you when we send it.
                    </p>

                    <div class="bg-light rounded-4 p-4 mt-4">

                        <h5 class="fw-bold mb-3">Order summary</h5>

                        @foreach($order->items as $item)

                            <div class="d-flex align-items-center mb-3">

                                <img src="{{ asset('uploads/products/' . $item->product->image) }}" width="70" class="rounded me-3">

                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <small class="text-muted">
                                        ₹{{ $item->price }}
                                    </small>
                                </div>

                                <div>
                                    x{{ $item->quantity }}
                                </div>

                            </div>

                            <hr>

                        @endforeach

                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>₹{{ $order->subtotal }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>VAT (20%)</span>
                            <span>₹{{ $order->vat }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>₹{{ $order->total }}</span>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection