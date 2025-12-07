@extends('admin.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Agents Add
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.agents') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Agents List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="agentForm" class="ajaxForm" action="{{ route('admin.agent.save') }}" method="post">
                                @csrf
                                <input type="hidden" name="agent_id" value="{{ optional($agent)->id }}">
                                <div class="row">

                                    <!-- Basic Info -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Agent Name</label>
                                        <input type="text" name="agent_name" value="{{ optional($agent)->agent_name }}"
                                            class="form-control required" placeholder="Agent Name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ optional($agent)->email }}"
                                            class="form-control required" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="mobile_number"
                                            value="{{ optional($agent)->mobile_number }}" class="form-control required"
                                            placeholder="Phone Number">
                                    </div>

                                    <!-- User Type -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">User Type</label>
                                        <select name="user_type" class="form-control required">
                                            <option value="1" @selected(optional($agent)->user_type == '1')>Agent</option>
                                            <option value="2" @selected(optional($agent)->user_type == '2')>Teamleader
                                            </option>
                                            <option value="3" @selected(optional($agent)->user_type == '3')>Supervisor
                                            </option>
                                            <option value="4" @selected(optional($agent)->user_type == '4')>Manager</option>
                                            <option value="5" @selected(optional($agent)->user_type == '5')>Cluster</option>
                                        </select>
                                    </div>

                                    <!-- User Group -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">User Group</label>>
                                        <select name="user_group" class="form-control required">
                                            <option value="">Select Group</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}"
                                                    @selected(optional($agent)->user_group == $group->id)>{{ $group->group_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Active Status -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Active</label>
                                        <select name="active" class="form-control">
                                            <option value="1" @selected(optional($agent)->active == '1')>Active</option>
                                            <option value="0" @selected(optional($agent)->active == '0')>Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Permissions / Settings -->
                                    <div class="col-md-12 mb-3">
                                        <h5>Permissions</h5>
                                        <div id="permissionWrapper" class="row">
                                            @foreach($permissions as $permission)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check permission-checkbox">
                                                        <input type="checkbox" class="form-check-input" id="{{ $permission }}"
                                                            name="{{ $permission }}" value="1" {{ optional($agent)->hasPermissionTo($permission) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="{{ $permission }}">{{ ucwords(str_replace('_', ' ', $permission)) }}</label>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Save Agent</button>
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