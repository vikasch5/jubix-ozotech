@extends('admin.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Agents List
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.agent.add') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Add New Agent</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Agent Name</th>
                                            <th scope="col">Agent Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agents as $agent)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                            {{ $agent->agent_name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ $agent->email }}</td>
                                                <td>{{ $agent->user_type == '1' ? 'Agent' : ($agent->user_type == '2' ? 'Team Leader' : ($agent->user_type == '3' ? 'Supervisor' : ($agent->user_type == '4' ? 'Manager' : ($agent->user_type == '5' ? 'Cluster' : '')))) }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($agent->active == '1')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{route('admin.agent.add', ['id' => $agent->id])}}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                                class="ri-edit-line"></i></a>
                                                        <a href="javascript:void(0);" data-id="{{ $agent->id }}"
                                                            data-url="{{ route('admin.agent.delete') }}"
                                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i
                                                                class="ri-delete-bin-line"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="m-4">
                                    {{ $agents->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection