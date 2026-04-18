@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title"> Pages List
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.pages.add') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Add Page</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">Page Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($pages->count() == 0)
                                            <tr>
                                                <td colspan="5" class="text-center">No Pages Found</td>
                                            </tr>
                                        @endif
                                        @foreach ($pages as $page)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                            {{ $page->page_name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($page->status == '1')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <input type="hidden" id="delete_url"
                                                        value="{{ route('admin.category.category') }}">
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{ route('admin.pages.add', $page->id) }}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                                class="ri-edit-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="m-4">
                                    {{ $pages->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection