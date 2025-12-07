@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Website Settings</div>
                        </div>

                        <div class="card-body">

                            <form id="settingsForm" class="ajaxForm" action="{{ route('admin.settings.save') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- Favicon -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Favicon (50x50)</label>
                                        <input type="file" name="favicon" class="form-control" accept="image/*">

                                        @if(!empty($setting->favicon))
                                            <img src="{{ asset($setting->favicon) }}" class="mt-2"
                                                style="width:50px;height:50px;">
                                        @endif
                                    </div>

                                    <!-- Logo -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Logo (200x100)</label>
                                        <input type="file" name="logo" class="form-control" accept="image/*">

                                        @if(!empty($setting->logo))
                                            <img src="{{ asset($setting->logo) }}" class="mt-2"
                                                style="width:120px;height:auto;">
                                        @endif
                                    </div>

                                    {{-- <div class="col-md-6 mb-3">
                                        <label class="form-label">Font Style</label>
                                        <select name="font_style" class="form-control required">
                                            <option value="default">Default</option>
                                            <option value="BF143HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF143HIN.TTF")>BF143HIN</option>
                                            <option value="BF096HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF096HIN.TTF")>BF096HIN</option>
                                            <option value="BF100HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF100HIN.TTF")>BF100HIN</option>
                                            <option value="BF102HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF102HIN.TTF")>BF102HIN</option>
                                            <option value="BF142HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF142HIN.TTF")>BF142HIN</option>
                                            <option value="BF082HIN.TTF" @selected(optional($setting)->font_style ==
                                                "BF082HIN.TTF")>BF082HIN</option>
                                        </select>
                                    </div> --}}
                                    <!-- Meta Title -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ $setting->meta_title ?? '' }}" placeholder="Website Meta Title">
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" rows="3" class="form-control"
                                            placeholder="Meta Description">{{ $setting->meta_description ?? '' }}</textarea>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <textarea name="meta_keywords" rows="3" class="form-control"
                                            placeholder="Meta Keywords">{{ $setting->meta_keywords ?? '' }}</textarea>
                                    </div>

                                    <!-- Social Links -->
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Social Media Links</h5>
                                        <hr>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" name="instagram" class="form-control" placeholder="Instagram URL"
                                            value="{{ $setting->instagram ?? '' }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" name="facebook" class="form-control" placeholder="Facebook URL"
                                            value="{{ $setting->facebook ?? '' }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Twitter (X)</label>
                                        <input type="text" name="twitter" class="form-control" placeholder="Twitter URL"
                                            value="{{ $setting->twitter ?? '' }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn URL"
                                            value="{{ $setting->linkedin ?? '' }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">WhatsApp Number / Link</label>
                                        <input type="text" name="whatsapp" class="form-control"
                                            placeholder="WhatsApp Link or Number" value="{{ $setting->whatsapp ?? '' }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">YouTube</label>
                                        <input type="text" name="youtube" class="form-control"
                                            placeholder="YouTube Channel URL" value="{{ $setting->youtube ?? '' }}">
                                    </div>

                                    <!-- Save -->
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Save Settings
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
        $(document).ready(function () {
            // You can add ajax success/error handlers if needed
        });
    </script>
@endsection