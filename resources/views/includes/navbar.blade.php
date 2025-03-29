<style>
    /* General Styling */
    body {
        background: url('https://via.placeholder.com/1920x1080') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Navbar Styling */
    .navbar {
        background: rgba(0, 0, 0, 0.7);
        padding: 15px 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 22px;
        color: #ffffff;
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.85);
        transition: color 0.3s ease-in-out;
        margin-right: 20px;
    }

    .navbar-nav .nav-link:hover {
        color: #f8f9fa;
    }

    /* Profile Image */
    .profile-img {
        border-radius: 50%;
        width: 70px;
        height: 70px;
    }

    /* Flexbox for Edit and Logout buttons */
    .navbar-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Responsive Navbar */
    @media (max-width: 992px) {
        .navbar-collapse {
            margin-top: 10px;
        }

        .navbar-nav .nav-link {
            margin-right: 0;
        }

        .profile-img {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 18px;
        }

        .navbar-nav .nav-link {
            margin-right: 10px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
        }

        .navbar-toggler-icon {
            background-color: rgb(121, 120, 120);
        }
    }
</style>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Left Side: Profile Image and User Name -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            @php
            // Retrieve authenticated user's image and name
            $profile_image = Auth::user()->image;
            $user_name = Auth::user()->name;
            @endphp

            <!-- Display profile image if exists, otherwise use a placeholder -->
            <img src="{{ $profile_image ? asset('images/' . $profile_image) : 'https://via.placeholder.com/150' }}" class="profile-img me-3" alt="Profile">

            <!-- Display user's name or fallback to 'User' if no name -->
            <h2 class="mb-0">Welcome, {{ $user_name ?? 'User' }}</h2>
        </a>

        <!-- Hamburger button for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsing Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <div class="navbar-actions">
                    <!-- Edit Profile Button -->
                    <li class="nav-item">
                        <a class="btn btn-primary me-3" href="{{ route('edit_profile', ['id' => Auth::id()]) }}">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profile
                        </a>
                    </li>

                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf <!-- CSRF Token for security -->
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>
