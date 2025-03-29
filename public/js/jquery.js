$(document).ready(function () {
    function applyValidation(formId) {
        $(formId).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 6
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                gender: {
                    required: true
                },
                type: {
                    required: true
                },
                // Custom validation for image
                image: {
                    required: false,  // Image is optional
                    extension: "jpg|jpeg|png|gif|svg",  // Allowed image formats
                    filesize: 2097152  // Maximum file size of 2MB (in bytes)
                }
            },
            messages: {
                name: {
                    required: "Please enter your name ",
                    minlength: "Name must be at least 6 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters"
                },
                mobile: {
                    required: "Please enter your mobile number",
                    digits: "Mobile number must contain only digits",
                    minlength: "Mobile number must be exactly 10 digits",
                    maxlength: "Mobile number must be exactly 10 digits"
                },
                gender: {
                    required: "Please select your gender"
                },
                type: {
                    required: "Please select your user type"
                },
                image: {
                    extension: "Only image files (jpg, jpeg, png, gif, svg) are allowed.",
                    filesize: "The image size must be less than 2MB."
                }
            },
            errorClass: "text-danger",
            errorElement: "div",
        });
    }

    // Apply validation to forms
    applyValidation("#registrationForm");
    applyValidation("#loginForm"); // Add more forms as needed
    applyValidation("#user-form"); 
    applyValidation("#loginForm"); 
});

// Custom jQuery validation method for checking file size
$.validator.addMethod("filesize", function (value, element, param) {
    var fileSize = element.files[0]?.size || 0; // Get the file size in bytes
    return this.optional(element) || (fileSize <= param);  // Param is the max allowed size (in bytes)
}, "File size is too large.");

// Custom jQuery validation method for checking file extension (image only)
$.validator.addMethod("extension", function (value, element, param) {
    var allowedExtensions = param.split("|");
    var fileName = element.value;
    var fileExtension = fileName.split('.').pop().toLowerCase();  // Extract the file extension
    return this.optional(element) || allowedExtensions.includes(fileExtension);
}, "Invalid file type.");
