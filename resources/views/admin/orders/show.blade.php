@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Order {{ $order->order_number }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">Items</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Deleted product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Address</div>
            <div class="card-body">
                @if ($order->address)
                    <p class="mb-1"><strong>Name:</strong> {{ $order->address->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->address->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->address->phone }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $order->address->address }}, {{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->country }} - {{ $order->address->zip_code }}</p>
                @else
                    <p class="mb-0">No address recorded.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">Summary</div>
            <div class="card-body">
                <p class="mb-1"><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                <p class="mb-1"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p class="mb-1"><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                <p class="mb-1"><strong>Tax:</strong> ${{ number_format($order->tax, 2) }}</p>
                <p class="mb-1"><strong>Shipping:</strong> ${{ number_format($order->shipping_cost, 2) }}</p>
                <p class="mb-0"><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <select name="order_status" class="form-select">
                            @foreach (['pending','processing','completed','cancelled'] as $status)
                                <option value="{{ $status }}" @selected($order->order_status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select name="payment_status" class="form-select">
                            @foreach (['pending','paid','failed'] as $status)
                                <option value="{{ $status }}" @selected($order->payment_status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
