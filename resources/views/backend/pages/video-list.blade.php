@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Video List
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('admin.video.add') }}"
                                   class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">
                                    Add Video
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>YouTube Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($videos->count() == 0)
                                            <tr>
                                                <td colspan="6" class="text-center">No Videos Found</td>
                                            </tr>
                                        @endif

                                        @foreach ($videos as $video)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                {{-- Thumbnail --}}
                                                <td>
                                                    @if($video->thumbnail)
                                                        <img src="{{ asset($video->thumbnail) }}"
                                                             style="width:70px;height:50px;object-fit:cover;border-radius:5px;">
                                                    @else
                                                        <img src="https://img.youtube.com/vi/{{ youtube_id($video->youtube_link) }}/mqdefault.jpg"
                                                             style="width:70px;height:50px;border-radius:5px;">
                                                    @endif
                                                </td>

                                                {{-- Title --}}
                                                <td>{{ $video->title }}</td>

                                                {{-- YouTube Link --}}
                                                <td>
                                                    <a href="{{ $video->youtube_link }}" target="_blank">
                                                        {{ Str::limit($video->youtube_link, 30) }}
                                                    </a>
                                                </td>

                                                {{-- Status --}}
                                                <td>
                                                    @if ($video->status == '1')
                                                        <span class="badge bg-outline-success">Active</span>
                                                    @else
                                                        <span class="badge bg-outline-secondary">Inactive</span>
                                                    @endif
                                                </td>

                                                {{-- Action Buttons --}}
                                                <td>
                                                    <input type="hidden" id="delete_url"
                                                           value="{{ route('admin.video.delete') }}"
                                                           >

                                                    <div class="hstack gap-2 fs-15">
                                                        <a href="{{ route('admin.video.add', $video->id) }}"
                                                           class="btn btn-icon btn-sm btn-info-transparent rounded-pill">
                                                            <i class="ri-edit-line"></i>
                                                        </a>

                                                        <a href="javascript:void(0);"
                                                           data-id="{{ $video->id }}"
                                                           class="btn btn-icon btn-sm btn-danger-transparent rounded-pill deleteRecord">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="m-4">
                                    {{ $videos->withQueryString()->links() }}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
