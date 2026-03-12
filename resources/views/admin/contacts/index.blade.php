@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Contact Messages</h2>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject ?? '-' }}</td>
                                <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="bg-light">
                                    <div class="small text-muted mb-1">
                                        Phone: {{ $message->phone ?? '-' }} |
                                        Project: {{ $message->project ?? '-' }}
                                    </div>
                                    <div>{{ $message->message }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No messages yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $messages->links() }}
    </div>
@endsection
