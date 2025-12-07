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
                                <a href="{{ route('forms.create') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Add Form Field</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">Field Name</th>
                                            <th scope="col">Field Type</th>
                                            <th scope="col">Placeholder</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fields as $field)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                            {{ $field->field_name }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ $field->field_type }}</td>
                                                <td>{{ $field->field_placeholder }}</td>
                                                <td class="text-center">
                                                    @if ($field->status == '1')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{route('forms.create', ['id' => $field->id])}}"
                                                            class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                                class="ri-edit-line"></i></a>
                                                        <a href="javascript:void(0);" data-id="{{ $field->id }}"
                                                            data-url="{{ route('forms.delete') }}"
                                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill deleteRecord"><i
                                                                class="ri-delete-bin-line"></i></a>

                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="m-4">
                                    {{-- {{ $agents->withQueryString()->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection