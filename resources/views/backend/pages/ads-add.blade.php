@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Add / Edit Ads</div>
                            <div class="right-btn">
                                <a href="{{ route('admin.ads.list') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Ads List</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="adsForm" class="ajaxForm" action="{{ route('admin.ads.save') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ads_id" value="{{ optional($ads)->id }}">

                                <div class="row">

                                    <!-- Ad Title -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Ad Title</label>
                                        <input type="text" name="title" class="form-control required"
                                            value="{{ optional($ads)->title }}" placeholder="Ad Title">
                                    </div>

                                    <!-- Ad Link -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Redirect Link</label>
                                        <input type="text" name="link" class="form-control"
                                            value="{{ optional($ads)->link }}" placeholder="https://example.com">
                                    </div>

                                    <!-- Ad Position -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Position</label>
                                        <select name="position" class="form-control required">

                                            <option value="">Select Position</option>
                                            <option value="header_below"
                                                @selected(optional($ads)->position == 'header_below')>Header Below Ad (970x250
                                                px)</option>

                                            <!-- Home Page Ads -->
                                            <optgroup label="Home Page Ads">
                                                <option value="home_right_1"
                                                    @selected(optional($ads)->position == 'home_right_1')>Home – Right Side
                                                    Ads
                                                    1 (276 x 400 px)</option>

                                                <option value="home_right_2"
                                                    @selected(optional($ads)->position == 'home_right_2')>Home – Right Side
                                                    Ads
                                                    2 (276 x 400 px)</option>
                                            </optgroup>

                                            <!-- News Page Ads -->
                                            <optgroup label="News Details Page Ads">
                                                <option value="news_inside"
                                                    @selected(optional($ads)->position == 'news_inside')>News – Inside Content
                                                </option>

                                                <option value="news_right_side"
                                                    @selected(optional($ads)->position == 'news_right_side')>News – Right
                                                    Sidebar</option>
                                            </optgroup>

                                        </select>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="active" @selected(optional($ads)->status == "active")>Active
                                            </option>
                                            <option value="inactive" @selected(optional($ads)->status == "inactive")>Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Ad Image -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Ad Image</label>
                                        <input type="file" name="images[]" id="ads_image" multiple class="form-control"
                                            accept="image/*">
                                    </div>

                                    <!-- Preview -->
                                    <div class="col-md-12 mb-3">
                                        <div id="preview_ads" class="d-flex flex-wrap">
                                            @if(!empty($ads) && !empty($ads->images))
                                                @foreach(json_decode($ads->images, true) as $img)
                                                    <div class="position-relative me-2 mb-2 uploaded-image">

                                                        <img src="{{ asset($img) }}"
                                                            style="width:180px;height:120px;object-fit:cover;border-radius:5px;">

                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-existing-image"
                                                            style="padding:0 5px;border-radius:50%;">×</button>

                                                        <input type="hidden" class="image-path" value="{{ $img }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ optional($ads)->id ? "Update Ads" : "Save Ads" }}
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
        $(document).on('change', '#ads_image', function () {

            let files = this.files;

            // Clear only "new selected" previews, keep existing images
            $(".new-preview").remove();

            $.each(files, function (i, file) {

                let reader = new FileReader();

                reader.onload = function (e) {
                    $("#preview_ads").append(`
                                                    <div class="position-relative me-2 mb-2 new-preview">
                                                        <img src="${e.target.result}"
                                                            style="width:180px;height:120px;object-fit:cover;border-radius:5px;">
                                                    </div>
                                                `);
                };

                reader.readAsDataURL(file);
            });

        });

        $(document).on('click', '.delete-existing-image', function () {

            let btn = $(this);
            let wrapper = btn.closest('.uploaded-image');  // image div
            let imagePath = wrapper.find('.image-path').val(); // path of image
            let adsId = $("input[name='ads_id']").val(); // ad ID

            Swal.fire({
                title: "Are you sure?",
                text: "This image will be deleted permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "{{ route('admin.ads.delete-image') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ads_id: adsId,
                        image: imagePath
                    },

                    success: function (res) {
                        if (res.success) {

                            // Remove image box smoothly
                            wrapper.fadeOut(200, function () {
                                $(this).remove();
                            });

                            Swal.fire("Deleted!", "Image removed successfully.", "success");

                        } else {
                            Swal.fire("Error!", "Could not delete image.", "error");
                        }
                    }
                });

            });
        });

    </script>
@endsection