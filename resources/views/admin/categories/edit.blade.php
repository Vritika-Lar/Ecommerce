@extends('admin.layouts.app')

@section('title', 'Add Categories')

@section('content')
<style>
    h3.text-white.p-2 {
    background-color:#165289;
}
    </style>
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-white p-2">Edit Categories</h3>
    <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="name" value="{{ $category->name }}"       class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection