@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">

                        <!-- Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title"> {{ optional($service)->id ? 'Edit' : 'Add' }} Service</div>
                            <div class="right-btn">
                                <a href="{{ route('admin.service.list') }}" class="btn btn-primary-light btn-wave">
                                    Service List
                                </a>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <form id="serviceForm" class="ajaxForm" action="{{ route('admin.service.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="service_id" value="{{ optional($service)->id }}">

                                <div class="row">

                                    <!-- Title -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Service Title</label>
                                        <input type="text" name="title" class="form-control required"
                                            value="{{ optional($service)->title }}" placeholder="Service Title">
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control required"
                                            value="{{ optional($service)->slug }}" placeholder="service-slug">
                                    </div>
                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="1" @selected(optional($service)->status == 1)>Active</option>
                                            <option value="0" @selected(optional($service)->status == 0)>Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="4" class="form-control" id="summernote"
                                            placeholder="Service Description">{{ optional($service)->description }}</textarea>
                                    </div>



                                    <!-- Image -->
                                    {{-- <div class="col-md-4 mb-3">
                                        <label class="form-label">Service Image</label>
                                        <input type="file" name="image" id="service_image" class="form-control"
                                            accept="image/*">
                                    </div>

                                    <!-- Image Preview -->
                                    <div class="col-md-12 mb-3">
                                        <div id="preview_image">
                                            @if(!empty($service->image))
                                            <div class="position-relative uploaded-image">
                                                <img src="{{ asset($service->image) }}"
                                                    style="width:180px;height:120px;object-fit:cover;border-radius:5px;">
                                            </div>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <!-- Submit -->
                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ optional($service)->id ? 'Update Service' : 'Save Service' }}
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
        // Image Preview
        $(document).on('change', '#service_image', function () {

            let file = this.files[0];

            if (!file) return;

            let reader = new FileReader();

            reader.onload = function (e) {
                $('#preview_image').html(`
                        <div class="position-relative new-preview">
                            <img src="${e.target.result}"
                                 style="width:180px;height:120px;object-fit:cover;border-radius:5px;">
                        </div>
                    `);
            };

            reader.readAsDataURL(file);
        });
    </script>
@endsection