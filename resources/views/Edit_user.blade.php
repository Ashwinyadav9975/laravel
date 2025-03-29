@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2>Edit User</h2>
                </div>

                <div class="card-body">
                    <!-- Form to edit user details -->
                    <form id="user-form" class="validateForm" method="POST" action="{{ route('user.update', $user->id) }}" autocomplete="on">
                        @csrf
                        @method('PUT') <!-- Ensure the method is set to PUT -->

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="50"
                                value="{{ old('name', $user->name) }}" autocomplete="name">
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" onkeypress="return isNumber(event)"
                                name="mobile" maxlength="10" value="{{ old('mobile', $user->mobile) }}" required autocomplete="tel">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required autocomplete="gender">
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Call the submitFormWithAjax function for user form update
        submitFormWithAjax(
            '#user-form', // The form ID selector
            '{{ route("user.update", $user->id) }}', // The URL for submitting the form
            function(response) { // Success callback function
                console.log(response);
            }
        );
    });
</script>

@endsection
