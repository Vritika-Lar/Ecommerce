@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<h2 class="mb-4">Orders</h2>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Order Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>{{ $order->items->sum('quantity') }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td><span class="badge bg-info text-dark text-uppercase">{{ $order->order_status }}</span></td>
                            <td><span class="badge bg-secondary text-uppercase">{{ $order->payment_status }}</span></td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.show', $order) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $orders->links() }}
</div>
@endsection
