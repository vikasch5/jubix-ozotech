@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                {{ isset($product) ? 'Edit Product' : 'Product Add' }}
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.product.list') }}"
                                   class="btn btn-primary-light btn-wave">
                                   Product List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <form action="{{ isset($product) ? route('admin.products.store', $product->id) : route('admin.products.store') }}"
                                class="ajaxForm"
                                method="POST" enctype="multipart/form-data">

                                @csrf

                                    <input type="hidden" name="product_id" value="{{ optional($product)->id }}">

                                <input type="hidden" id="subcategory_get_url" value="{{ route('admin.get.subcategories') }}">

                                <div class="row">
                                    <!-- Product Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name="product_name"
                                               class="form-control required"
                                               value="{{ $product->product_name ?? '' }}"
                                               placeholder="Enter product name">
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-select required">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Sub Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Sub Category</label>
                                        <select name="sub_category_id" id="sub_category_id"
                                            class="form-select required">
                                            <option value="">Select Sub Category</option>

                                            @if(isset($subcategories))
                                                @foreach($subcategories as $sub)
                                                    <option value="{{ $sub->id }}"
                                                        @selected($sub->id==$product->sub_category_id)>
                                                        {{ $sub->sub_category_name }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" name="price"
                                            class="form-control required"
                                            value="{{ $product->price ?? '' }}"
                                            placeholder="Enter price">
                                    </div>

                                    <!-- Product Images -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Product Images</label>
                                        <input type="file" name="images[]" id="product_images" class="form-control" multiple accept="image/*">
                                    </div>

                                    <!-- Preview -->
                                    <div class="col-md-12 mb-3">
                                        <div id="preview_product_images" class="d-flex flex-wrap gap-2">

                                            @if (!empty($product) && !empty($product->images))
                                                @foreach (json_decode($product->images, true) as $key => $img)

                                                    <div class="position-relative me-2 mb-2 uploaded-product-image" data-key="{{ $key }}">

                                                        <!-- Existing Image -->
                                                        <img src="{{ asset('storage/'.$img) }}"
                                                            style="width:120px; height:100px; object-fit:cover; border-radius:5px;">

                                                        <!-- Delete Icon -->
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-product-image"
                                                                style="padding:0 5px; border-radius:50%;">
                                                            ×
                                                        </button>

                                                        <!-- Hidden Image Path -->
                                                        <input type="hidden" class="product-image-path" value="{{ $img }}">
                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4"
                                            placeholder="Enter description">{{ $product->description ?? '' }}</textarea>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($product) ? 'Update Product' : 'Save Product' }}
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

@section('scripts')
<script>
    // Preview newly selected images
$(document).on('change', '#product_images', function () {

    var files = this.files;

    $.each(files, function (i, file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#preview_product_images").append(`
                <img src="${e.target.result}" 
                     class="img-thumbnail"
                     style="width:120px;height:120px;object-fit:cover;margin-right:8px;">
            `);
        };

        reader.readAsDataURL(file);
    });

});


// Delete old product image
$(document).on('click', '.delete-product-image', function () {

    let container = $(this).closest('.uploaded-product-image');
    let imagePath = container.find('.product-image-path').val();
    let productId = $('input[name="id"]').val(); // product id

    Swal.fire({
        title: "Are you sure?",
        text: "This image will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('admin.products.delete-image') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    image: imagePath,
                },
                success: function (res) {

                    if (res.success) {

                        container.fadeOut(300, function () {
                            $(this).remove();
                        });

                        Swal.fire(
                            "Deleted!",
                            "Image removed successfully.",
                            "success"
                        );

                    } else {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                }
            });

        }

    });

});

</script>
@endsection
