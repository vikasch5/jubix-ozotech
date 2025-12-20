@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                {{ optional($page)->id ? 'Edit Page' : 'Add Page' }}
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.pages.list') }}" class="btn btn-primary-light btn-wave">
                                    Page List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="ajaxForm" action="{{ route('admin.pages.store-or-update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="page_id" value="{{ optional($page)->id }}">

                                <div class="row">

                                    <!-- Page Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Page Name</label>
                                        <select name="page_name" class="form-control required">
                                            <option value="">-- Select Page --</option>
                                            <option value="about-us" @selected(optional($page)->page_name == 'about-us')>
                                                About Us
                                            </option>
                                            <option value="privacy-policy"
                                                @selected(optional($page)->page_name == 'privacy-policy')>
                                                Privacy Policy
                                            </option>
                                            <option value="terms-conditions"
                                                @selected(optional($page)->page_name == 'terms-conditions')>
                                                Terms & Conditions
                                            </option>
                                        </select>
                                        @error('page_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="1" @selected(optional($page)->status == 1)>Active</option>
                                            <option value="0" @selected(optional($page)->status == 0)>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3 d-none" id="aboutImageBox">
                                        <label class="form-label">About Us Image <span class="text-danger">*</span></label>
                                        <input type="file" name="image" class="form-control">
                                        @if(optional($page)->image)
                                            <img src="{{ asset('uploads/pages/' . $page->image) }}" class="mt-2" width="120">
                                        @endif
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ optional($page)->meta_title }}" placeholder="Meta Title">
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" rows="3" class="form-control"
                                            placeholder="Meta Description">{{ optional($page)->meta_description }}</textarea>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <textarea name="meta_keywords" rows="3" class="form-control"
                                            placeholder="Meta Keywords">{{ optional($page)->meta_keywords }}</textarea>
                                    </div>

                                    <!-- Page Content -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Page Content</label>
                                        <textarea name="content" id="summernote" class="form-control summernote" rows="8">
                                                        {{ optional($page)->content }}
                                                    </textarea>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ optional($page)->id ? 'Update Page' : 'Save Page' }}
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
        function toggleImageField() {
            let page = $('select[name="page_name"]').val();
            if (page === 'about-us') {
                $('#aboutImageBox').removeClass('d-none');
            } else {
                $('#aboutImageBox').addClass('d-none');
            }
        }

        $('select[name="page_name"]').on('change', toggleImageField);
        toggleImageField(); // on page load
    </script>

@endsection