@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">

                        <!-- HEADER -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Contact Us Leads
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($leads as $lead)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>
                                                    <strong>{{ $lead->name }}</strong>
                                                </td>

                                                <td>{{ $lead->email }}</td>

                                                <td>{{ $lead->phone ?? '-' }}</td>

                                                <td>{{ $lead->subject ?? '-' }}</td>

                                                <td style="max-width: 250px;">
                                                    {{ \Str::limit($lead->message, 60) }}
                                                </td>

                                                <td>
                                                    {{ $lead->created_at->format('d M Y') }}
                                                </td>



                                                <td class="text-center">
                                                    <div class="hstack gap-2 justify-content-center fs-15">

                                                        <!-- DELETE -->
                                                        <input type="hidden" id="delete_url"
                                                            value="{{ route('admin.contact.delete') }}">
                                                        <a href="javascript:void(0);" data-id="{{ $lead->id }}"
                                                            class="btn btn-icon btn-sm btn-danger-transparent rounded-pill deleteRecord"
                                                            title="Delete">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    No Contact Leads Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <!-- PAGINATION -->
                                <div class="m-4">
                                    {{ $leads->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection