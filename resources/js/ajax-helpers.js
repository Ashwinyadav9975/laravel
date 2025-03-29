// Common AJAX form submission function
// function submitFormWithAjax(formId, url, successCallback) {
//     $(formId).submit(function(event) {
//         event.preventDefault();  // Prevent normal form submission
//         if (!$(this).valid()) return false;  // Ensure form is valid

//         let formData = $(this).serialize();  // Serialize form data

//         $.ajax({
//             url: url,  // The URL for the AJAX request
//             type: 'POST',  // Use POST for form submission
//             data: formData,  // The serialized form data
//             dataType: 'json',  // Expect a JSON response
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
//             },
//             success: function(response) {
//                 if (response.status === 'error') {  // If the response status is error
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.message
//                     });
//                 } else if (response.status === 'success') {  // If the response status is success
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success!',
//                         text: response.message
//                     }).then(() => {
//                         window.location.href = response.redirect || "{{ route('login') }}";  // Redirect to another page on success
//                     });
//                 } else {  // For unexpected errors
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Unexpected Error!',
//                         text: 'Something went wrong. Please try again later.'
//                     });
//                 }

//                 // Call custom callback after success if provided
//                 if (successCallback) {
//                     successCallback(response);
//                 }
//             },
//             error: function() {  // Handle AJAX errors
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error!',
//                     text: 'Something went wrong. Please try again.'
//                 });
//             }
//         });
//     });
// }
// Function to handle form submission via AJAX
// function submitFormWithAjax(formId, url, successCallback) {
//     $(formId).submit(function(event) {
//         event.preventDefault();  // Prevent normal form submission
//         if (!$(this).valid()) return false;  // Ensure form is valid before proceeding

//         let formData = $(this).serialize();  // Serialize the form data

//         $.ajax({
//             url: url,  // The URL for the AJAX request
//             type: 'POST',  // Use POST for form submission
//             data: formData,  // The serialized form data
//             dataType: 'json',  // Expect a JSON response
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token
//             },
//             success: function(response) {
//                 // Handle the response based on status
//                 if (response.status === 'error') {  // If the response status is 'error'
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.message
//                     });
//                 } else if (response.status === 'success') {  // If the response status is 'success'
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success!',
//                         text: response.message
//                     }).then(() => {
//                         // Redirect to the provided URL after success or fallback to a default route
//                         window.location.href = response.redirect || "{{ route('login') }}";
//                     });
//                 } else {  // For unexpected or unhandled response status
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Unexpected Error!',
//                         text: 'Something went wrong. Please try again later.'
//                     });
//                 }

//                 // Call custom callback after success if provided
//                 if (successCallback) {
//                     successCallback(response);
//                 }
//             },
//             error: function(xhr, status, error) {  // Handle AJAX request errors
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error!',
//                     text: 'Something went wrong. Please try again.'
//                 });
//             }
//         });
//     });
// }
