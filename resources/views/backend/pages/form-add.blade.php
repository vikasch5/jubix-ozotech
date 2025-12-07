@extends('admin.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Add Form Field
                            </div>
                            <div class="right-btn">
                                <a href="{{ route('forms.index') }}"
                                    class="btn btn-primary-light btn-wave me-2 waves-effect waves-light">Field
                                    List</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="formFieldForm" action="{{ route('forms.save') }}" method="POST" class="ajaxForm">
                                @csrf
                                <div class="row">

                                    <input type="hidden" name="field_id" id="field_id" value="{{ optional($field)->id }}">

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Field Name</label>
                                        <input type="text" name="field_name" value="{{ optional($field)->field_name }}"
                                            class="form-control required" placeholder="Field Name" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Placeholder</label>
                                        <input type="text" name="field_placeholder"
                                            value="{{ optional($field)->field_placeholder }}" class="form-control"
                                            placeholder="Enter Placeholder">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Field Type</label>
                                        <select name="field_type" id="field_type" class="form-control" required>
                                            <option value="">Select Type</option>
                                            <option value="text" @selected(optional($field)->field_type == 'text')>Text
                                            </option>
                                            <option value="number" @selected(optional($field)->field_type == 'number')>Number
                                            </option>
                                            <option value="email" @selected(optional($field)->field_type == 'email')>Email
                                            </option>
                                            <option value="tel" @selected(optional($field)->field_type == 'tel')>Tel</option>
                                            <option value="select" @selected(optional($field)->field_type == 'select')>Select
                                            </option>
                                            <option value="radio" @selected(optional($field)->field_type == 'radio')>Radio
                                            </option>
                                            <option value="checkbox" @selected(optional($field)->field_type == 'checkbox')>
                                                Checkbox</option>
                                            <option value="readonly" @selected(optional($field)->field_type == 'readonly')>
                                                Readonly</option>
                                            <option value="hidden" @selected(optional($field)->field_type == 'hidden')>Hidden
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Row Rank --}}
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Field Rank (Row)</label>
                                        <select name="field_rank_row" id="field_rank_row" class="form-control" required>
                                            <option value="">Select Row</option>
                                            @foreach ($availableRows as $row)
                                                <option value="{{ $row }}" @selected(optional($field)->field_rank_row == $row)>
                                                    Row {{ $row }}
                                                </option>
                                            @endforeach
                                            @if (!optional($field)->id)
                                                <option value="{{ $availableRows->max() + 1 }}">New Row
                                                    ({{ $availableRows->max() + 1 }})</option>
                                            @endif

                                        </select>
                                    </div>

                                    {{-- Column Rank --}}
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Field Rank (Column)</label>
                                        <select name="field_rank_col" id="field_rank_col" class="form-control" required>
                                            <option value="">Select Column</option>
                                            @foreach ($availableCols as $col)
                                                <option value="{{ $col }}" @selected(optional($field)->field_rank_col == $col)>
                                                    Column {{ $col }}
                                                </option>
                                            @endforeach
                                            @if (!optional($field)->id)
                                                <option value="{{ $availableCols->max() + 1 }}">New Column
                                                    ({{ $availableCols->max() + 1 }})</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Field Size (1–50)</label>
                                        <input type="number" name="field_size" value="{{ optional($field)->field_size }}"
                                            class="form-control" min="1" max="50" placeholder="12" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Is Required?</label>
                                        <select name="is_required" class="form-control">
                                            <option value="0" @selected(optional($field)->is_required == '0')>No</option>
                                            <option value="1" @selected(optional($field)->is_required == '1')>Yes</option>
                                        </select>
                                    </div>

                                    {{-- Field Options (hidden by default) --}}
                                    <div class="col-md-8 mb-3" id="field_options_box" style="display: none;">
                                        <label class="form-label">Field Options (comma separated)</label>
                                        <input type="text" name="field_options" id="field_options"
                                            value="{{ optional($field)->field_options }}" class="form-control"
                                            placeholder="Option1, Option2, Option3">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @selected(optional($field)->status == '1')>Active</option>
                                            <option value="0" @selected(optional($field)->status == '0')>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Save Field</button>
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

@section('scripts')
    <script>
        $(document).ready(function () {

            function toggleOptionsBox() {
                const type = $('#field_type').val();

                if (['select', 'radio', 'checkbox'].includes(type)) {
                    $('#field_options_box').slideDown(200);

                    // Optional: change placeholder dynamically
                    let placeholderText = 'Option1, Option2, Option3';
                    if (type === 'select') placeholderText = 'Dropdown Option1, Option2...';
                    if (type === 'radio') placeholderText = 'Radio Option1, Option2...';
                    if (type === 'checkbox') placeholderText = 'Checkbox Option1, Option2...';
                    $('#field_options').attr('placeholder', placeholderText);

                } else {
                    $('#field_options_box').slideUp(200);
                    $('#field_options').val('');
                }
            }

            // Bind change event
            $('#field_type').on('change', toggleOptionsBox);

            // Trigger once on page load (for edit form)
            toggleOptionsBox();
        });
    </script>
@endsection