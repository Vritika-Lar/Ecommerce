@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

    <style>
        h2.header {
            background-color: #165289;
            color: white;
            padding: 10px;
        }

        a.text-primary.ms-1 {
            text-decoration: none;
        }
    </style>



    <h2 class="header">Products</h2>

    {{-- ADD PRODUCT FORM --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">

        @csrf

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">

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
                        <option value="{{$cat->id}}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>

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

            {{-- IMAGE PREVIEW --}}
            <div class="mt-2">
                <img id="imagePreview" src="" style="display:none; max-width:150px;" class="img-thumbnail">
            </div>
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1">

            <label class="form-check-label">
                Featured Product
            </label>
        </div>
        <button class="btn btn-success">Add Product</button>
    </form>

    {{-- PRODUCT TABLE --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($product as $prod)
                <tr>
                    <td> {{ $prod->id}}</td>
                    <td>{{ $prod->name }}</td>
                    <td>{{ $prod->price}}</td>
                    @php
                        $fullDesc = $prod->description;
                        $limit = 8;
                    @endphp

                    <td>
                        {{-- SHORT DESCRIPTION --}}
                        <span class="short-desc">
                            {{ \Illuminate\Support\Str::limit($fullDesc, $limit) }}
                        </span>

                        {{-- FULL DESCRIPTION (only if length > limit) --}}
                        @if(strlen($fullDesc) > $limit)
                            <span class="full-desc d-none">
                                {{ $fullDesc }}
                            </span>

                            <a href="javascript:void(0)" class="text-primary ms-1" onclick="toggleDescription(this)">
                                More
                            </a>
                        @endif
                    </td>


                    <td>
                        <img src="{{ asset('uploads/products/' . $prod->image) }}" width="60">
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>


                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            data-id="{{ $prod->id }}">
                            Delete
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DELETE MODAL (ONLY ONCE) --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>

                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

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
    <script>
        function toggleDescription(el) {
            const td = el.closest('td');
            const shortDesc = td.querySelector('.short-desc');
            const fullDesc = td.querySelector('.full-desc');

            shortDesc.classList.toggle('d-none');
            fullDesc.classList.toggle('d-none');

            el.innerText = el.innerText === 'More' ? 'Less' : 'More';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteModal');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const productId = button.getAttribute('data-id');

                const form = document.getElementById('deleteForm');
                form.action = `/admin/products/${productId}`;
            });
        });
    </script>


@endsection
