@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Newsletter Subscribers</h2>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Subscribed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No subscribers yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $subscribers->links() }}
    </div>
@endsection
