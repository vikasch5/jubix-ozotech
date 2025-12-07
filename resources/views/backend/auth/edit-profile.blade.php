@extends('backend.common.master')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">

                    <div class="card custom-card overflow-hidden">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                User Profile Update
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- ============================
                                         FORM 1 — NAME + PHOTO
                                    =============================== -->

                            <form method="POST" id="changeProfilePhoto" action="{{ route('user.updateProfilePhoto') }}"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="row g-3">

                                    <!-- Name -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control required"
                                            value="{{ Auth::user()->name }}" placeholder="Enter Name">
                                    </div>

                                    <!-- Profile Photo -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label class="form-label">Profile Photo <span class="text-danger">*</span></label>
                                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 col-md-6 col-lg-3 mt-5">
                                        <button type="submit" name="form_type" value="profile"
                                            class="btn btn-primary">Update Profile</button>
                                    </div>

                                </div>

                            </form>

                            <!-- Divider -->
                            <hr class="my-4">

                            <!-- ============================
                                         FORM 2 — PASSWORD RESET
                                    =============================== -->

                            <div class="px-2 pb-2">
                                <h5 class="mb-3">Password Reset</h5>
                            </div>

                            <form method="POST" id="passwordChangeForm" action="{{ route('user.updatePassword') }}">

                                @csrf

                                <div class="row g-3">

                                    <!-- New Password -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="new_password" class="form-control required"
                                            placeholder="Enter New Password">
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="confirm_new_password" class="form-control required"
                                            placeholder="Confirm Password">
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 col-md-6 col-lg-3 mt-5">
                                        <button type="submit" name="form_type" value="password"
                                            class="btn btn-primary">Update Password</button>
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
        $('#changeProfilePhoto').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = new FormData(this);

            // ---- VALIDATION ----

            // 1. Name required
            let name = $('input[name="name"]').val().trim();
            if (name === '') {
                Swal.fire('Error', 'Name is required.', 'error');
                return false;
            }

            // 2. Image validation only if file selected
            const fileInput = $('input[name="profile_photo"]')[0];

            if (fileInput.files.length > 0) {

                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                let fileType = fileInput.files[0].type;

                if (!allowedTypes.includes(fileType)) {
                    Swal.fire('Error', 'Only JPG, JPEG, and PNG files are allowed.', 'error');
                    return false;
                }

                // Size check optional (2MB example)
                let fileSize = fileInput.files[0].size;
                if (fileSize > 2 * 1024 * 1024) {
                    Swal.fire('Error', 'Image must be less than 2MB.', 'error');
                    return false;
                }
            }

            // ---- Confirmation ----
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update your profile?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Update',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (!result.isConfirmed) return;

                // ---- AJAX SUBMIT ----
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        Swal.close();

                        if (response.status === 'success') {
                            notify_it('success', response.message, response.redirect_url);

                            // Reset form
                            form[0].reset();

                            // Update profile preview
                            if (response.profile_photo_url) {
                                $('#profilePreview').attr('src', response.profile_photo_url + '?t=' + new Date().getTime());
                            }

                        } else {
                            notify_it('error', response.message);
                        }
                    },

                    error: function (xhr) {
                        Swal.close();

                        if (xhr.status === 422 && xhr.responseJSON) {
                            const response = xhr.responseJSON;
                            let messages = [];

                            if (response.errors) {
                                for (let field in response.errors) {
                                    response.errors[field].forEach(msg => {
                                        messages.push(msg);
                                    });
                                }
                            }

                            if (messages.length === 0 && response.message) {
                                messages.push(response.message);
                            }

                            notify_it('error', messages.join('<br>'));
                        } else {
                            notify_it('error', 'An unexpected error occurred.');
                        }
                    }
                });

            });

        });


        $('#passwordChangeForm').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = new FormData(this);
            const newPassword = $('input[name="new_password"]').val();
            const confirmPassword = $('input[name="confirm_new_password"]').val();

            if (newPassword !== confirmPassword) {
                Swal.fire('Error', 'Passwords do not match.', 'error');
                return false;
            }
            if (!form.valid()) {
                return false; // Stop submission if validation fails
            }
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to change your password?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Change',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: form.attr('action'), // get form action dynamically
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        Swal.close();
                        if (response.status) {
                            notify_it('success', response.message);
                            form[0].reset();
                        } else {
                            notify_it('error', response.message);
                        }
                    },
                    error: function (xhr) {
                        Swal.close();
                        if (xhr.status === 422 && xhr.responseJSON) {
                            const response = xhr.responseJSON;
                            let messages = [];

                            if (response.errors) {
                                for (let field in response.errors) {
                                    response.errors[field].forEach(msg => {
                                        messages.push(msg);
                                    });
                                }
                            }

                            if (messages.length === 0 && response.message) {
                                messages.push(response.message);
                            }

                            notify_it('Error', messages.join('<br>'));
                        } else {
                            notify_it('Error', 'An unexpected error occurred.');
                        }
                    }
                });
            });
        });
    </script>
@endsection