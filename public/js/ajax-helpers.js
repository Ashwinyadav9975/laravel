function submitFormWithAjax(formId, url, method, successCallback) {
    $(formId).submit(function(event) {
        event.preventDefault();  // Prevent normal form submission
        if (!$(this).valid()) return false;  // Ensure form is valid before proceeding

        let formData = new FormData(this);  // Use FormData to include the image file

        $.ajax({
            url: url,  // The URL for the AJAX request
            type: method,  // Use PUT or POST for form submission
            data: formData,  // The FormData object (including the file)
            dataType: 'json',  // Expect a JSON response
            processData: false,  // Don't process data (important for file uploads)
            contentType: false,  // Don't set content-type header
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
            },
            success: function(response) {
                Swal.fire({
                    icon: response.status,
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message
                }).then(() => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: ", status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });
    });
}
