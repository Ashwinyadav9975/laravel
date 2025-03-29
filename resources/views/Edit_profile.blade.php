@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Edit Profile</h2>
                </div>


                <div class="card-body">
                    <!-- Form to edit user details -->
                    <form id="user-form" method="POST" class="validateForm" action="{{ route('userprofile.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Ensure the method is set to PUT -->

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" maxlength="50" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" value="{{ old('mobile', $user->mobile) }}" required>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender" required>
            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Choose Profile Picture</label>
        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png, .gif" />
        <small class="text-muted">Accepted file types: JPG, JPEG, PNG, GIF (Max size: 5MB)</small>
    </div>

    <div class="w-100">
        <div class="row">
            <div class="col-7">
                <button type="submit" name="submit" class="btn btn-success w-100">Update Profile</button>
            </div>
            <div class="col-4">
                <a href="{{ route('home') }}" class="btn btn-danger w-100">Cancel</a>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Use submitFormWithAjax for the user form update
        submitFormWithAjax(
            '#user-form',  // Form ID selector
            '{{ route("userprofile.update", $user->id) }}',  // URL to send the form data to (for PUT request)
            'PUT',  // HTTP method (PUT in this case for update)
            function(response) {  // Success callback (optional)
                // Additional actions after form submission if necessary
                console.log(response);
            }
        );
    });
</script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- 
<script>
    // Function to handle form submission via AJAX
    $(document).ready(function() {
        $('#user-form').on('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission

            let formData = new FormData(this); // Get form data

            $.ajax({
                url: '{{ route("user.update", $user->id) }}', // URL to send the request to
                method: 'PUT', // Use PUT for updating
                data: formData, // Data to send
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Handle success response (e.g., display success message)
                        alert('User updated successfully!');
                        // Optionally, you can redirect to another page or update the UI
                    } else {
                        // Handle error response
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    alert('Something went wrong! Please try again.');
                }
            });
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        // Use submitFormWithAjax for the user form update
        submitFormWithAjax(
            '#user-form',  // Form ID selector
            '{{ route("user.update", $user->id) }}',  // URL to send the form data to (for PUT request)
            'PUT',  // HTTP method (PUT in this case for update)
            function(response) {  // Success callback (optional)
                // Additional actions after form submission if necessary
                console.log(response);
            }
        );
    });
</script>

@endsection