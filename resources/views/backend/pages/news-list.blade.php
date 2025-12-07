@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                News List
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.news.add') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Add News</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Show On Homepage</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($news->count() == 0)
                                            <tr>
                                                <td colspan="5" class="text-center">No News Found</td>
                                            </tr>
                                        @endif
                                        @foreach ($news as $new)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                            {{ $new->title }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ $new->slug }}</td>
                                                <td>
                                                    @if ($new->show_on_home == '1')
                                                        <span class="badge bg-outline-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($new->status == 'active')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" id="delete_url"
                                                        value="{{ route('admin.news.delete') }}">
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{ route('admin.news.add', $new->id) }}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                                class="ri-edit-line"></i></a>
                                                        <a href="javascript:void(0);" data-id="{{ $new->id }}"
                                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill deleteRecord"><i
                                                                class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="m-4">
                                    {{ $news->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection