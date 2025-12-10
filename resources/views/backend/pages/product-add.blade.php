<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Product Add
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.category.index') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Category List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <!-- Product Name -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
        </div>

        <!-- Category -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sub Category -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Sub Category</label>
            <select name="sub_category_id" class="form-select">
                <option value="">Select Sub Category</option>
            </select>
        </div>

        <!-- Price -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Enter price">
        </div>

        <!-- Images -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Product Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <!-- Status -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Description -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
        </div>

        <!-- Submit -->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                Save Product
            </button>
        </div>

    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection