@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">

                    <div class="card custom-card overflow-hidden">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Ads List</div>
                            <div class="right-btn">
                                <a href="{{ route('admin.ads.add') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">
                                    Add Ads
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0">

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($ads->count() == 0)
                                            <tr>
                                                <td colspan="6" class="text-center py-4">No Ads Found</td>
                                            </tr>
                                        @endif

                                        @foreach ($ads as $ad)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $ad->title }}</td>
                                                <td>
                                                    @php
                                                        $images = $ad->images ? json_decode($ad->images, true) : [];
                                                        $firstImage = $images[0] ?? null;
                                                    @endphp

                                                    @if($firstImage)
                                                        <img src="{{ asset($firstImage) }}"
                                                            style="width:80px;height:60px;object-fit:cover;border-radius:4px;">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="badge bg-outline-info">
                                                        {{ strtoupper(str_replace('_', ' ', $ad->position)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($ad->status == 'active')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" id="delete_url"
                                                        value="{{ route('admin.ads.delete') }}">

                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{ route('admin.ads.add', $ad->id) }}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill">
                                                            <i class="ri-edit-line"></i>
                                                        </a>

                                                        <a href="javascript:void(0);" data-id="{{ $ad->id }}"
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
                                    {{ $ads->withQueryString()->links() }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection