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
                                News Add
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.news.list') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">News List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="newsForm" class="ajaxForm" action="{{ route('admin.news.store-or-update') }}"
                                method="post" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="news_id" value="{{ optional($news)->id }}">

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control required"
                                            value="{{ optional($news)->title }}" placeholder="News Title">
                                    </div>

                                    <!-- Reporter -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Reporter Name</label>
                                        <input type="text" name="reporter_name" class="form-control"
                                            value="{{ optional($news)->reporter_name }}" placeholder="Reporter Name">
                                    </div>

                                    <!-- Category -->
                                    <input type="hidden" id="subcategory_get_url"
                                        value="{{ route('admin.get.subcategories') }}">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-control required">
                                            <option value="">Select Category</option>

                                            @foreach ($all_categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    @selected(optional($news)->category_id == $cat->id)>
                                                    {{ $cat->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Sub Category -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Sub Category</label>
                                        <select name="sub_category_id" id="sub_category_id" class="form-control">
                                            <option value="">Select Sub Category</option>
                                            @if (!empty($subCategory))
                                                @foreach ($subCategory as $subCat)
                                                    <option value="{{ $subCat->id }}"
                                                        @selected(optional($news)->sub_category_id == $subCat->id)>
                                                        {{ $subCat->sub_category_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="active" @selected(optional($news)->status == "active")>Publish
                                            </option>
                                            <option value="inactive" @selected(optional($news)->status == "inactive")>
                                                Unpublish</option>
                                        </select>
                                    </div>

                                    <!-- Show on Home -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Show on Home</label>
                                        <select name="show_on_home" class="form-control">
                                            <option value="0" @selected(optional($news)->show_on_home == '0')>No</option>
                                            <option value="1" @selected(optional($news)->show_on_home == '1')>Yes</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Is Breaking News</label>
                                        <select name="is_breaking_news" class="form-control required">
                                            <option value="0" @selected(optional($news)->is_breaking_news == '0')>NO</option>
                                            <option value="1" @selected(optional($news)->is_breaking_news == '1')>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Is Highlight</label>
                                        <select name="is_highlight" class="form-control required">
                                            <option value="0" @selected(optional($news)->is_highlight == '0')>NO</option>
                                            <option value="1" @selected(optional($news)->is_highlight == '1')>Yes</option>
                                        </select>
                                    </div>
                                    <!-- News Images -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">News Images</label>
                                        <input type="file" name="news_images[]" id="news_images" class="form-control"
                                            multiple accept="image/*">
                                    </div>

                                    <!-- Preview -->
                                    <div class="col-md-12 mb-3">
                                        <div id="preview_images" class="d-flex flex-wrap gap-2">

                                            @if(!empty($news) && !empty($news->images))
                                                @foreach(json_decode($news->images, true) as $key => $img)

                                                    <div class="position-relative me-2 mb-2 uploaded-image" data-key="{{ $key }}">

                                                        <!-- Image -->
                                                        <img src="{{ asset($img) }}"
                                                            style="width:120px; height:100px; object-fit:cover; border-radius:5px;">

                                                        <!-- Delete Button -->
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-existing-image"
                                                            style="padding:0 5px; border-radius:50%;">
                                                            ×
                                                        </button>

                                                        <!-- Store Image Path For Delete -->
                                                        <input type="hidden" class="image-path" value="{{ $img }}">
                                                    </div>

                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ optional($news)->meta_title }}" placeholder="Meta Title">
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" rows="3" class="form-control"
                                            placeholder="Meta Description">{{ optional($news)->meta_description }}</textarea>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <textarea name="meta_keywords" rows="3" class="form-control"
                                            placeholder="Meta Keywords">{{ optional($news)->meta_keywords }}</textarea>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="summernote" rows="4" class="form-control"
                                            placeholder="Full News Description">{{ optional($news)->description }}</textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ optional($news)->id ? "Update News" : "Save News" }}
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

        $(document).on('change', '#news_images', function () {

            // $("#preview_images").html(""); // clear previous images

            var files = this.files;

            $.each(files, function (i, file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#preview_images").append(`
                                                            <img src="${e.target.result}" 
                                                                 class="img-thumbnail"
                                                                 style="width:120px;height:120px;object-fit:cover;margin-right:8px;">
                                                        `);
                };

                reader.readAsDataURL(file);
            });

        });

        $(document).on('click', '.delete-existing-image', function () {

            let container = $(this).closest('.uploaded-image'); // image box
            let imagePath = container.find('.image-path').val(); // image url/path
            let newsId = $('input[name="news_id"]').val(); // current news id

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
                        url: "{{ route('admin.news.delete-image') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            news_id: newsId,
                            image: imagePath,
                        },
                        success: function (res) {

                            if (res.status === true) {

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