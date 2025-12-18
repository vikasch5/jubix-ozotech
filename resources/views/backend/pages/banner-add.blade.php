@extends('backend.common.master')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card overflow-hidden">

                    <!-- Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                            {{ optional($banner)->id ? 'Edit' : 'Add' }} Banner
                        </div>
                        <div class="right-btn">
                            <a href="{{ route('admin.banner.list') }}" class="btn btn-primary-light btn-wave">
                                Banner List
                            </a>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <form id="bannerForm" class="ajaxForm"
                              action="{{ route('admin.banner.save') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="banner_id" value="{{ optional($banner)->id }}">

                            <div class="row">

                                <!-- Banner Image -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Banner Image (1700x500)</label>
                                    <input type="file" name="image" id="banner_image"
                                           class="form-control {{ empty(optional($banner)->id) ? 'required' : '' }}"
                                           accept="image/*">
                                </div>

                                <!-- Status -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control required">
                                        <option value="1" @selected(optional($banner)->status == 1)>Active</option>
                                        <option value="0" @selected(optional($banner)->status == 0)>Inactive</option>
                                    </select>
                                </div>

                                <!-- Image Preview -->
                                <div class="col-md-12 mb-3">
                                    <div id="preview_image">
                                        @if(!empty($banner->image))
                                            <div class="position-relative uploaded-image">
                                                <img src="{{ asset($banner->image) }}"
                                                     style="width:300px;height:140px;object-fit:cover;border-radius:6px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ optional($banner)->id ? 'Update Banner' : 'Save Banner' }}
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
