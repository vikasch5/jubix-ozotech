$(document).ready(function () {

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        $('.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');

        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            beforeSend: function () {
                // disable button while submitting
                form.find('input[type="submit"]').val('Signing in...').prop('disabled', true);
            },
            success: function (response) {
                form.find('input[type="submit"]').val('Sign In').prop('disabled', false);

                if (response.success) {
                    window.location.href = response.redirect_url || "{{ route('admin.dashboard') }}";
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    }
                } else {
                    $('#login-alert').addClass('alert-danger').text(response.message).show();
                    setTimeout(function () {
                        $('#login-alert').fadeOut();   // or .hide()
                    }, 3000);

                }
            },
            error: function (xhr) {
                form.find('input[type="submit"]').val('Sign In').prop('disabled', false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        let input = form.find('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="text-danger mt-1">' + messages[0] + '</div>');
                    });
                } else {
                    notify_it('error', 'An unexpected error occurred. Please try again later.');
                }
            }
        });
    });
});