@extends('backend.common.master')
@section('content')
    <style>
        .spec-item {
            background: #f9fafb;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        .spec-item:hover {
            background: #f1f5f9;
            border-color: #ddd;
        }

        .spec-key,
        .spec-value {
            border-radius: 8px;
        }

        .remove-spec {
            border-radius: 8px;
        }
    </style>
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                {{ $product ? 'Edit Product' : 'Add Product' }}
                            </div>

                            <div class="right-btn">
                                <a href="{{ route('admin.product.list') }}" class="btn btn-primary-light btn-wave">
                                    Product List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- FORM -->
                            <form action="{{ route('admin.products.store') }}" class="ajaxForm" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <!-- Hidden product ID -->
                                <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                                <input type="hidden" id="subcategory_get_url"
                                    value="{{ route('admin.get.subcategories') }}">

                                <div class="row">

                                    <!-- Product Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ $product->product_name ?? '' }}" placeholder="Enter product name">
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $product && $product->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Sub Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Sub Category</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-select">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ $product && $product->sub_category_id == $sub->id ? 'selected' : '' }}>
                                                    {{ $sub->sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">MRP Price</label>
                                        <input type="number" name="price" class="form-control"
                                            value="{{ $product->price ?? '' }}" placeholder="Enter MRP price">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Sale Price</label>
                                        <input type="number" name="sale_price" class="form-control"
                                            value="{{ $product->sale_price ?? '' }}" placeholder="Enter sale price">
                                    </div>

                                    <!-- Product Images Upload -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Product Images</label>
                                        <input type="file" name="images[]" id="product_images" class="form-control"
                                            multiple accept="image/*">
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-md-12 mb-3">
                                        <div id="preview_product_images" class="d-flex flex-wrap gap-2">

                                            @if ($product && $product->images)
                                                @foreach (json_decode($product->images, true) as $img)
                                                    <div class="position-relative uploaded-product-image">

                                                        <img src="{{ asset('storage/' . $img) }}"
                                                            style="width:120px;height:100px;object-fit:cover;border-radius:5px;">

                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-product-image"
                                                            style="padding:0 5px;border-radius:50%;">×</button>

                                                        <input type="hidden" class="product-image-path"
                                                            value="{{ $img }}">
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1"
                                                {{ $product && $product->status == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ $product && $product->status == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4" id="summernote" placeholder="Enter description">{{ $product->description ?? '' }}</textarea>
                                    </div>
                                    <!-- =======================
            PRODUCT SPECIFICATIONS
        ======================= -->
                                    <div class="col-md-12 mt-4">
                                        <div class="card shadow-sm border-0">

                                            <div
                                                class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 fw-semibold">
                                                    <i class="ri-list-check-2"></i> Product Specifications
                                                </h5>

                                                <button type="button" id="add_spec" class="btn btn-primary btn-sm">
                                                    <i class="ri-add-line"></i> Add Spec
                                                </button>
                                            </div>

                                            <div class="card-body">

                                                <div id="specifications_wrapper">

                                                    @if ($product && $product->specifications)
                                                        @foreach (json_decode($product->specifications, true) as $spec)
                                                            <div class="spec-item">
                                                                <div class="row g-2 align-items-center">

                                                                    <div class="col-md-5">
                                                                        <input type="text" name="spec_key[]"
                                                                            class="form-control spec-key"
                                                                            value="{{ $spec['key'] }}"
                                                                            placeholder="Specification (e.g. Color)">
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <input type="text" name="spec_value[]"
                                                                            class="form-control spec-value"
                                                                            value="{{ $spec['value'] }}"
                                                                            placeholder="Value (e.g. Red)">
                                                                    </div>

                                                                    <div class="col-md-2 text-end">
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger remove-spec">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>

                                                <!-- Empty State -->
                                                <div id="empty_spec" class="text-center text-muted py-3"
                                                    {{ $product && $product->specifications ? 'style=display:none;' : '' }}>
                                                    No specifications added yet
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ $product ? 'Update Product' : 'Save Product' }}
                                        </button>
                                    </div>

                                </div> <!-- row -->
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
        /* --------------------------------------
           IMAGE PREVIEW
        -------------------------------------- */
        $(document).on('change', '#product_images', function() {
            let files = this.files;

            $.each(files, function(i, file) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $("#preview_product_images").append(`
                <img src="${e.target.result}"
                     class="img-thumbnail"
                     style="width:120px;height:120px;object-fit:cover;margin-right:8px;">
            `);
                };

                reader.readAsDataURL(file);
            });
        });


        /* --------------------------------------
           DELETE EXISTING IMAGE (NO AJAX)
        -------------------------------------- */
        $(document).on('click', '.delete-product-image', function() {

            let container = $(this).closest('.uploaded-product-image');
            let imagePath = container.find('.product-image-path').val();
            let productId = $('input[name="product_id"]').val(); // product id

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
                        success: function(res) {

                            if (res.success) {

                                container.fadeOut(300, function() {
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

        /* ADD SPEC */
        $(document).on('click', '#add_spec', function() {

            $('#empty_spec').hide();

            let html = `
        <div class="spec-item">
            <div class="row g-2 align-items-center">

                <div class="col-md-5">
                    <input type="text" name="spec_key[]" 
                        class="form-control spec-key"
                        placeholder="Specification (e.g. Color)">
                </div>

                <div class="col-md-5">
                    <input type="text" name="spec_value[]" 
                        class="form-control spec-value"
                        placeholder="Value (e.g. Black)">
                </div>

                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-outline-danger remove-spec">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>

            </div>
        </div>
    `;

            $('#specifications_wrapper').append(html);
        });


        /* REMOVE SPEC */
        $(document).on('click', '.remove-spec', function() {

            $(this).closest('.spec-item').remove();

            if ($('.spec-item').length === 0) {
                $('#empty_spec').show();
            }
        });
    </script>
@endsection
