<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link href="{{ asset('css/home/sidebar.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-lg-2 ps-0  sidebar border-end ms-3">
                <div class="position-fixed">
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
                                <a href="{{ route('home.search') }}" class="nav-link">
                                    <i class="bi bi-search"></i>
                                    Search
                                </a>


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
                                <ul class="dropdown-menu mt-2" aria-labelledby="notificationLink"
                                    id="notificationDropdown">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i> Likes</a>
                                    </li>
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
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>
                                            Settings</a>
                                    </li>
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
            </div>
            <!-- Content Adel-->
            <div class="col-9">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->


    <script src="{{ asset('js/home/modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')

</body>

</html>
