@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<h2 class="text-white p-2" style="background-color:#165289;">Categories</h2>

<form action="{{ route('categories.store') }}" method="POST" class="mb-4">
    @csrf

    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Category name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror">
            <option value="1" @selected(old('status') == '1')>Active</option>
            <option value="0" @selected(old('status') == '0')>Inactive</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success">Add</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $category->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">Are you sure you want to delete this category?</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const categoryId = button.getAttribute('data-id');
            document.getElementById('deleteForm').action = `/categories/${categoryId}`;
        });
    });
</script>
@endsection
