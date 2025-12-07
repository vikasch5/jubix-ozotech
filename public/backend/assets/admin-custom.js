function notify_it(status, message, redirectUrl = null, type = 'alert', options = {}) {
    const defaultTitle = status.charAt(0).toUpperCase() + status.slice(1);
    if (type === 'alert') {
        return Swal.fire({
            icon: status,
            title: options.title || defaultTitle,
            html: message,
            // timer: options.timer || 2000,
            showConfirmButton: true, // Show button
            confirmButtonText: options.confirmButtonText || "Okay", // Button label
            showCloseButton: options.showCloseButton ?? false, // Optional X button
            allowOutsideClick: false, // Prevent closing by clicking outside
            allowEscapeKey: false // Prevent closing with Esc key
        }).then((result) => {
            if (redirectUrl && result.isConfirmed) {
                window.location.href = redirectUrl;
            }
        });
    }

    // Toast notification
    if (type === 'toast') {
        if (typeof flasher[status] === 'function') {
            flasher[status](message);
            if (redirectUrl) {
                setTimeout(() => {
                    window.location.href = redirectUrl;
                }, options.redirectDelay || 2000);
            }
        } else {
            console.error(`Invalid toast status: ${status}`);
        }
        return;
    }
}
$(document).ready(function () {
    $(document).on('submit', '.ajaxForm', function (e) {
        e.preventDefault();
        var $form = $(this);

        if (!$form.valid()) return; // jQuery validation

        var $submitBtn = $form.find('[type="submit"]');
        $submitBtn.prop('disabled', true); // disable submit

        var formData = new FormData(this);

        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method') || 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $submitBtn.prop('disabled', false); // enable submit
                if (response.success) {
                    notify_it('success', response.message);

                    // Reset form if it's a create form
                    if (!$form.find('[name$="_id"]').val()) {
                        $form[0].reset();
                        if ($form.find('.summernote').length) {
                            $form.find('.summernote').each(function () {
                                $(this).summernote('code', '');
                            });
                        }
                    }

                    // Redirect if needed
                    if (response.redirect_url) {
                        setTimeout(function () {
                            window.location.href = response.redirect_url;
                        }, 2000);
                    }
                } else {
                    notify_it('error', response.message);
                }
            },
            error: function (xhr) {
                $submitBtn.prop('disabled', false); // enable submit
                let messages = [];
                if (xhr.status === 422 && xhr.responseJSON) {
                    const response = xhr.responseJSON;
                    if (response.errors) {
                        for (let field in response.errors) {
                            response.errors[field].forEach(msg => messages.push(msg));
                        }
                    }
                    if (messages.length === 0 && response.message) {
                        messages.push(response.message);
                    }
                } else {
                    messages.push('An unexpected error occurred.');
                }
                notify_it('error', messages.join('<br>'));
            }
        });
    });

});

$(document).on('click', '.deleteRecord', function () {
    const $button = $(this);
    const actionUrl = $('#delete_url').val();
    const courseId = $button.data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this record?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: { id: courseId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        $button.closest('tr').fadeOut(500, function () { $(this).remove(); });
                        notify_it('success', response.message, response.redirect_url);
                    } else {
                        notify_it('error', response.message);
                    }
                },
                error: function (xhr) {
                    let messages = [];
                    if (xhr.status === 422 && xhr.responseJSON) {
                        const response = xhr.responseJSON;
                        if (response.errors) {
                            for (let field in response.errors) {
                                response.errors[field].forEach(msg => messages.push(msg));
                            }
                        }
                        if (messages.length === 0 && response.message) {
                            messages.push(response.message);
                        }
                    } else {
                        messages.push('An unexpected error occurred.');
                    }
                    notify_it('error', messages.join('<br>'));
                }
            });
        }
    });
});

$(document).on('change', 'select[name="user_type"]', function () {

    let type = $(this).val();
    let agentId = $('input[name="agent_id"]').val(); // hidden field
    if (!type) {
        $('#permissionWrapper').html('');
        return;
    }

    $.ajax({
        url: "/admin/get-role-permissions/" + type,
        type: "GET",
        data: {
            agent_id: agentId   // ✅ send agent id
        },
        success: function (response) {
            $('#permissionWrapper').html(response.html);
        }
    });

});

$('#category_id').on('change', function () {
    let categoryID = $(this).val();
    let url = $('#subcategory_get_url').val();

    if (categoryID) {
        $.ajax({
            url: url + '/' + categoryID,
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                let subCategoryDropdown = $('#sub_category_id');
                subCategoryDropdown.empty();
                subCategoryDropdown.append('<option value="">Select Sub Category</option>');

                if (response.success && response.data.length > 0) {
                    $.each(response.data, function (index, subCat) {
                        subCategoryDropdown.append(
                            `<option value="${subCat.id}">${subCat.sub_category_name}</option>`
                        );
                    });
                }
            }
        });
    } else {
        $('#sub_category_id').empty();
        $('#sub_category_id').append('<option value="">Select Sub Category</option>');
    }
});
