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
                            Banner List
                        </div>
                        <div class="right-btn">
                            <a href="{{ route('admin.banner.add') }}"
                               class="btn btn-primary-light btn-wave me-2">
                                Add Banner
                            </a>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th>Banner Image</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($banners->count() == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No Banners Found
                                            </td>
                                        </tr>
                                    @endif

                                    @foreach ($banners as $banner)
                                        <tr>
                                            <th class="text-center">
                                                {{ $loop->iteration }}
                                            </th>

                                            <!-- Banner Image -->
                                            <td>
                                                <img src="{{ asset($banner->image) }}"
                                                     style="width:220px;height:70px;object-fit:cover;border-radius:6px;">
                                            </td>

                                            <!-- Status -->
                                            <td>
                                                @if ($banner->status == 1)
                                                    <span class="badge bg-outline-success">Active</span>
                                                @else
                                                    <span class="badge bg-outline-secondary">Inactive</span>
                                                @endif
                                            </td>

                                            <!-- Action -->
                                            <td class="text-center">
                                                <input type="hidden" id="delete_url"
                                                       value="{{ route('admin.banner.delete') }}">

                                                <div class="hstack gap-2 fs-15 justify-content-center">
                                                    <a href="{{ route('admin.banner.add', $banner->id) }}"
                                                       class="btn btn-icon btn-sm btn-info-transparent rounded-pill">
                                                        <i class="ri-edit-line"></i>
                                                    </a>

                                                    <a href="javascript:void(0);"
                                                       data-id="{{ $banner->id }}"
                                                       class="btn btn-icon btn-sm btn-danger-transparent rounded-pill deleteRecord">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="m-4">
                                {{ $banners->withQueryString()->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
