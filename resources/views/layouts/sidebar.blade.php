<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">

    <title>@yield('title')</title>

    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Profile CSS -->
    <link href="{{ asset('css/profile_view.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/posts/post_view.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        body {
            background-color: white;
        }

        a>img,
        .nav-link>span {
            vertical-align: middle;
            margin-right: 10px;
        }

        a>img {
            width: 20px;
            height: 20px;
        }

        img {
            cursor: pointer;
        }

        .sidebar .nav-link {
            color: black;
            font-size: 1.1rem;
            padding: 14px 1px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar .bi {
            margin-right: 14px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 200px;
        }

        .dropdown-menu {
            border: none;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform-origin: top;
            transform: translateY(-100%);
            width: 250px;
        }

        .dropdown-menu .dropdown-item {
            color: #000;
            font-size: 1rem;
            padding: 14px 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-lg-2 ps-0  sidebar border-end ms-3">
                <div class="d-flex flex-column align-items-start px-3  mt-5 ps-1">
                    <img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png"
                        title="Instagram" alt="Instagram Logo" class="img-fluid mb-4">

                    <ul class="nav flex-column mb-0">
                        <li class="nav-item">
                            <a href="{{ route('home.index') }}" class="nav-link">
                                <img src="/assets/home.png" alt="">
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="searchLink">
                                <i class="bi bi-search"></i> Search
                            </a>
                            <ul class="dropdown-menu mt-2" aria-labelledby="searchLink" id="searchDropdown">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Search
                                        Users</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-hash"></i> Search Tags</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="/assets/social.png" alt="">
                                <span>Explore</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="/assets/video.png" alt="">
                                <span>Reels</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="/assets/chat.png" alt="">
                                <span>Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="notificationLink">
                                <img src="/assets/heart.png" alt="">
                                <span>Notifications</span>
                            </a>
                            <ul class="dropdown-menu mt-2" aria-labelledby="notificationLink" id="notificationDropdown">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i> Likes</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-chat-left-dots"></i>
                                        Comments</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img src="/assets/more.png" alt="">
                                <span>Create</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}"
                                class="nav-link">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" id="moreDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i> More
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('profile.show', ['username' => Auth::user()->username]) }}"><i
                                            class="bi bi-bookmark"></i> Saved</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i>
                                        Switch Account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>
                                        Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content-->
            <div class="col-9">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')

</body>

</html>
