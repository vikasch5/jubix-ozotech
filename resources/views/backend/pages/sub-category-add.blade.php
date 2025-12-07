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
                                Sub Category Add
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.sub.category.index') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Sub Category
                                    List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="categoryForm" class="ajaxForm"
                                action="{{ route('admin.sub.category.store-or-update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sub_category_id" value="{{ optional($category)->id }}">

                                <div class="row">

                                    <!-- Category Name -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" class="form-control required">
                                            <option value="">Select Category</option>
                                            @foreach ($all_categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    @selected(optional($category)->category_id == $cat->id)>
                                                    {{ $cat->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Sub Category Name</label>
                                        <input type="text" name="sub_category_name" class="form-control required"
                                            value="{{ optional($category)->sub_category_name }}"
                                            placeholder="Sub Category Name">
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Category Slug -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Slug (Auto-generated if blank)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ optional($category)->slug }}" placeholder="Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Category Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="1" @selected(optional($category)->status == 1)>Active</option>
                                            <option value="0" @selected(optional($category)->status == 0)>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-md-4 mb-3">
                                        <label class="form-label">Show on Homepage</label>
                                        <select name="show_on_home" class="form-control required">
                                            <option value="0" @selected(optional($category)->show_on_home == 0)>NO</option>
                                            <option value="1" @selected(optional($category)->show_on_home == 1)>Yes</option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <!-- Category Image -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Category Image</label>
                                        <input type="file" name="sub_category_image" class="form-control">

                                        @error('sub_category_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if(optional($category)->image)
                                        <div class="col-md-4 mb-3">

                                            <img src="{{ asset('uploads/sub-category/' . $category->image) }}"
                                                style="width: 100px; margin-top: 8px; border-radius: 6px;">
                                        </div>
                                    @endif


                                    <!-- Meta Title -->
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ optional($category)->meta_title }}" placeholder="Meta Title">
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" rows="3" class="form-control"
                                            placeholder="Meta Description">{{ optional($category)->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <textarea name="meta_keywords" rows="3" class="form-control"
                                            placeholder="Meta Keywords">{{ optional($category)->meta_keywords }}</textarea>
                                        @error('meta_keywords')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    {{-- <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="4" class="form-control"
                                            placeholder="Category Description">{{ optional($category)->description }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary">{{ optional($category)->id ? "Update Category" : "Save Categroy" }}</button>
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