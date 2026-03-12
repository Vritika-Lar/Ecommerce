@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Admin Dashboard</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h6 class="card-title">Products</h6>
                <p class="display-6 mb-0">{{ $stats['products'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success">
            <div class="card-body">
                <h6 class="card-title">Orders</h6>
                <p class="display-6 mb-0">{{ $stats['orders'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning">
            <div class="card-body">
                <h6 class="card-title">Users</h6>
                <p class="display-6 mb-0">{{ $stats['users'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-dark">
            <div class="card-body">
                <h6 class="card-title">Revenue</h6>
                <p class="display-6 mb-0">${{ number_format($stats['revenue'], 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Recent Orders</span>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Placed</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a>
                            </td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td><span class="badge bg-secondary text-uppercase">{{ $order->order_status }}</span></td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
