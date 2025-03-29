@extends("layouts.app")

@section("title", "home")

@section("content")



    <div class="container">
        <h2 class="text-center">User List</h2>
        <table id="users-table" class="display" style="width:100%">
            <thead class="text-center">
                <tr>
                <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>User Type</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

<script>
    $(document).ready(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home') }}", // Ensure the correct route for your home method
        columns: [
            
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },  // Decrypted email
            { data: 'mobile' },  // Decrypted mobile
            { data: 'gender' },
            { data: 'user_type' },
            // { data: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>




@endsection