@extends('admin.layouts.app')

@section('title', 'products')

@section('content')
    <style>
        h3.text-white.p-2 {
            background-color: #165289;
        }
    </style>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3 class="text-white p-2">Edit Products</h3>
        <div class="mb-3">
            <label>Products Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Select Category</label>
            <div class="mb-3">
                <select class="form-select" name="category_id">
                    <option value="" selected disabled>Select </option>
                    @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                rows="4">{{ old('description', $product->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Image</label>

            <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror"
                accept="image/*" onchange="previewImage(event)">

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- EXISTING IMAGE (DB) --}}
            <div class="mt-2">
                <img id="imagePreview" src="{{ $product->image ? asset('uploads/products/' . $product->image) : '' }}"
                    style="max-width:150px; display: {{ $product->image ? 'block' : 'none' }};" class="img-thumbnail">
            </div>
        </div>


        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>

            <label class="form-check-label">
                Featured Product
            </label>
        </div>

        <button class="btn btn-success">Update</button>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
