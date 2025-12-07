@extends('admin.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Group {{ $group ? 'Edit' : 'Add' }}
                            </div>
                            @if ($group)
                            <div class="right-btn">
                                <a href="{{ route('admin.usergroup') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Add Group</a>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form id="agentForm" class="ajaxForm" action="{{ route('admin.usergroup.save') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="group_id" value="">
                                <div class="row">

                                    <!-- Basic Info -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Group Name</label>
                                        <input type="text" name="group_name" value="{{ optional($group)->group_name }}"
                                            class="form-control required" placeholder="Group Name">
                                    </div>

                                    <!-- Active Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Active</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @selected(optional($group)->status == '1')>Active</option>
                                            <option value="0" @selected(optional($group)->status == '0')>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 p-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Group List
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">Group Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groups as $group)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                            {{ $group->group_name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($group->status == '1')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{route('admin.usergroup', ['id' => $group->id])}}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                                class="ri-edit-line"></i></a>
                                                        <a href="javascript:void(0);" data-id="{{ $group->id }}" data-url="{{ route('admin.usergroup.delete') }}"
                                                            class="deleteRecord btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i
                                                                class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 <div class="m-4">
                                    {{ $groups->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection