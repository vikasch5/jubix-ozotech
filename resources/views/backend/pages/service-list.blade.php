@extends('backend.common.master')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">

                <div class="card custom-card overflow-hidden">

                    <!-- Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Services List</div>
                        <div class="right-btn">
                            <a href="{{ route('admin.service.add') }}"
                               class="btn btn-primary-light btn-wave">
                                Add Service
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
                                        <th>Title</th>
                                        {{-- <th>Image</th> --}}
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($services->count() == 0)
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                No Services Found
                                            </td>
                                        </tr>
                                    @endif

                                    @foreach ($services as $service)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>

                                            <td>{{ $service->title }}</td>

                                            <td>
                                                @if($service->image)
                                                    <img src="{{ asset('uploads/services/'.$service->image) }}"
                                                         style="width:80px;height:60px;object-fit:cover;border-radius:4px;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>

                                            <td>
                                                    {{ $service->slug }}
                                            </td>

                                            <td>
                                                @if ($service->status == 1)
                                                    <span class="badge bg-outline-success">Active</span>
                                                @else
                                                    <span class="badge bg-outline-secondary">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <input type="hidden" id="delete_url"
                                                       value="{{ route('admin.service.delete') }}">

                                                <div class="hstack gap-2 fs-15">
                                                    <a href="{{ route('admin.service.add', $service->id) }}"
                                                       class="btn btn-icon btn-sm btn-info-transparent rounded-pill">
                                                        <i class="ri-edit-line"></i>
                                                    </a>

                                                    <a href="javascript:void(0);"
                                                       data-id="{{ $service->id }}"
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
                                {{ $services->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
