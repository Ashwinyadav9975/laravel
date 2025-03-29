@extends("layouts.app")

@section("title", "home")
@section("navbar")
@include('includes.navbar')
@endsection

@section("content")
<div class="container">
    @php
    $authUser = Auth::user();
    @endphp
</div>

<style>
    /* General Styling for the Table */
    table.dataTable {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;  /* Add border to cells */
        text-align: center;
        padding: 10px;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    /* Hover effect for rows */
    tr:hover {
        background-color:rgb(141, 140, 140);
    }

    /* Make the table responsive */
    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto; /* Ensures scrolling if needed */
    }

    /* Responsive behavior for mobile */
    @media screen and (max-width: 768px) {
        th, td {
            font-size: 14px;
        }
    }

    /* Additional custom style for DataTables */
    .dataTables_length,
    .dataTables_filter,
    .dataTables_paginate {
        margin-top: 20px;
    }
</style>

<!-- DataTable Display -->
<div class="container">
    <table id="users-table" class="display table table-bordered" style="width:100%">
        <thead class="text-center bg-info">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>User Type</th>

                @if ($authUser && $authUser->user_type === 'admin')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        var authUserType = '{{ Auth::user() ? Auth::user()->user_type : "" }}';

        var columns = [{
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }, {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'mobile'
            },
            {
                data: 'gender'
            },
            {
                data: 'user_type'
            }
        ];

        // Conditionally add the "Actions" column if the user is an admin
        if (authUserType === 'admin') {
            columns.push({
                data: 'action',
                orderable: false,
               
            });
        }

        // Initialize DataTable
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,  // Make the table responsive
            searching: true,  // Disable search input (optional)
            ajax: '{{ route("users.fetch") }}',
            columns: columns
        });

        // Delete and Edit functionality for Admin
        $(document).ready(function() {
    $(document).on('click', '#delete-btn', function() {
        var userId = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/user/' + userId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: () => Swal.fire('Deleted!', 'User deleted successfully.', 'success').then(() => $('#users-table').DataTable().ajax.reload()),
                    error: (err) => Swal.fire('Oops...', err.responseJSON.error || 'Error occurred.', 'error')
                });
            }
        });
    });
});


        $(document).on('click', '.edit-btn', function() {
            var userId = $(this).data('id');
            window.location.href = '/user/edit/' + userId;
        });
        
        $(document).on('click', '.editprofile-btn', function() {
            var userId = $(this).data('id');
            window.location.href = '/userprofile/edit/' + userId;
        });
    });
</script>

@endsection
