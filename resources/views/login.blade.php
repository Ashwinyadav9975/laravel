@extends("layouts.app")

@section("title", "login")

@section("content")


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Login Form</h2>
                </div>

           

                <div class="card-body">
                    <form method="post" id="loginForm" >
                        @csrf <!-- CSRF Token for Laravel Security -->

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        </div>

                        <button type="submit" class="btn btn-secondary w-100">Login</button>

                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- <script>
    $(document).ready(function() {
        $("#loginForm").submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('login_user.post') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                 headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(response) {
                    if (response.status === 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    } else if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again.'
                    });
                }
            });
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        // Call the common AJAX function for the login form
        submitFormWithAjax("#loginForm", "{{ route('login_user.post') }}", function(response) {
            // Optionally handle additional actions after success here
            console.log('Login response:', response);
        });
    });
</script>


@endsection