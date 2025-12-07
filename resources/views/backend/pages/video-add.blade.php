@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Video Add
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.video.list') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">
                                    Video List
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="videoForm" class="ajaxForm" action="{{ route('admin.video.store-or-update') }}"
                                method="post">

                                @csrf
                                <input type="hidden" name="video_id" value="{{ optional($video)->id }}">

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control required"
                                            value="{{ optional($video)->title }}" placeholder="Video Title">
                                    </div>

                                    {{-- YouTube Link --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">YouTube Link</label>
                                        <input type="text" name="youtube_link" id="youtube_link"
                                            class="form-control required" value="{{ optional($video)->youtube_link }}"
                                            placeholder="https://www.youtube.com/watch?v=XXXXXXX">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                            value="{{ optional($video)->slug }}" placeholder="Enter Slug (Optional)">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control required">
                                            <option value="0" @selected(optional($video)->status == "0")>Unpublish</option>
                                            <option value="1" @selected(optional($video)->status == "1")>Publish
                                            </option>

                                        </select>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="summernote" rows="4" class="form-control"
                                            placeholder="Video description...">{{ optional($video)->description }}</textarea>
                                    </div>

                                    {{-- Meta Title --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ optional($video)->meta_title }}" placeholder="Meta Title">
                                    </div>

                                    {{-- Meta Details --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Details</label>
                                        <textarea name="meta_details" rows="3" class="form-control"
                                            placeholder="Meta Details">{{ optional($video)->meta_details }}</textarea>
                                    </div>

                                    {{-- Meta Keywords --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <textarea name="meta_keyword" rows="3" class="form-control"
                                            placeholder="keyword1, keyword2, keyword3">{{ optional($video)->meta_keyword }}</textarea>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ optional($video)->id ? 'Update Video' : 'Save Video' }}
                                        </button>
                                    </div>

                                </div> {{-- row --}}
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection