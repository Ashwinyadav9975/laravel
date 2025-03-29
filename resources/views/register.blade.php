@extends("layouts.app")

@section("title", "user")


@section("content")






<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 my-3 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Sign Up</h2>
                </div>
                <div class="card-body">
                    <form id="registrationForm">
                        @csrf <!-- CSRF Token -->
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" onkeypress="return isText(event)" id="name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required minlength="6" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" name="mobile" onkeypress="return isNumber(event)" id="mobile" required minlength="10" maxlength="10" pattern="[0-9]+">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="">Select your gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">User Type</label>
                                    <select name="user_type" id="user_type" class="form-select" required>
                                        <option value="">Select your user type</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100">Submit</button>

                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 
<script>
    // Form submission with AJAX
    $(document).ready(function() {
        $("#registrationForm").submit(function(event) {
            event.preventDefault();
            if (!$(this).valid()) return false;

            $.ajax({
                url: '{{ route("register.post") }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'error') { // Correctly checking for error status
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message
                        });
                    } else if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => window.location.href = response.redirect || "{{ route('login') }}");
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Unexpected Error!',
                            text: 'Something went wrong. Please try again later.'
                        });
                    }
                },

                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Registration failed!'
                    });
                }
            });
        });
    });
</script> -->

<script>
    $(document).ready(function() {
        // Call the common AJAX function for the registration form
        submitFormWithAjax("#registrationForm", '{{ route("register.post") }}', function(response) {
            // Optionally handle additional actions after success here
            console.log('Registration response:', response);
        });
    });
</script>


@endsection