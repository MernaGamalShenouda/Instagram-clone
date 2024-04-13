<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $user = \App\Models\User::where('username', 'Instagram')->first();
    ?>
    @extends('layouts.sidebar')

    @section('title', 'Instagram')

    @section('content')

        @yield ('home_content')
        <div class="row ">
            <div class='col-9'>
            <div class="row">
                <div class="row story-circles" style="margin-top: 15px; margin-left: 2px;">
                
                    @foreach($followedUsers as $followedUsers)
                        @php
                            if ($followedUsers->image) {
                                $image =
                                    'https://res.cloudinary.com/dp3xwqpsq/image/upload/' .
                                    json_decode($followedUsers->image);
                            }
                        @endphp
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $followedUsers->username]) }}">
                                    <img src="{{ $followedUsers->image ? $image : $followedUsers->avatar }}" alt="{{ $followedUsers->username }}" class="img-fluid">
                                </a>
                            </div>
                            <p>{{ strlen($followedUsers->username) > 9 ? substr($followedUsers->username, 0, 9) . '...' : $followedUsers->username }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
                <!-- <div class="row">
                    <div class="row story-circles" style="margin-top: 15px; margin-left: 2px;">
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                    <img src="{{ asset('images\home\stories\flower.jpg') }}" alt="User 1"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">

                                    <img src="{{ asset('images\home\stories\Spider.jpeg') }}" alt="User 2"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }} </p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">

                                    <img src="{{ asset('images\home\stories\Hacker.jpeg') }}" alt="User 3"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }} </p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                    <img src="{{ asset('images\home\stories\girl.jpeg') }}" alt="User 4"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">

                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">
                                    <img src="{{ asset('images\home\stories\Tom.jpeg') }}" alt="User 5"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }}</p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">

                                    <img src="{{ asset('images\home\stories\Spider.jpeg') }}" alt="User 2"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }} </p>
                        </div>
                        <div class="col-1 story mx-3">
                            <div class="story-circle">
                                <a href="{{ route('profile.show', ['username' => $user->username]) }}">

                                    <img src="{{ asset('images\home\stories\Spider.jpeg') }}" alt="User 2"
                                        class="img-fluid">
                                </a>
                            </div>
                            <p>{{ $user->username }} </p>
                        </div>
                    </div>
                </div> -->
                <div class="container-posts">
                    @foreach ($posts as $post)
                        @php
                            if ($post->user->image) {
                                $image =
                                    'https://res.cloudinary.com/dp3xwqpsq/image/upload/' .
                                    json_decode($post->user->image);
                            }

                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <a href="{{ route('profile.show', ['username' => $post->user->username]) }}">
                                                <img src="{{ $post->user->image ? $image : $post->user->avatar }}"
                                                    alt="{{ $post->user->username }}" class="img-fluid w-100">
                                            </a>
                                        </div>
                                        <a href="{{ route('profile.show', ['username' => $post->user->username]) }}">

                                            <span class="username mx-2">

                                                <h5>{{ $post->user->username }}</h5>
                                            </span>
                                        </a>
                                        <span class="created-at">
                                           <h6> {{ $post->created_at ? $post->created_at->diffForHumans(null, true) : '' }}</h6></span>
                                    </div>
                                    <button type="button" class="btn btn-sm rounded-circle ellipsis">
                                        <i class="fas fa-ellipsis-h" style="color: black !important;"></i>
                                    </button>
                                </div>
                                <div>
                                    @php
                                        $images = json_decode($post->images);
                                    @endphp
                                    @foreach ($images as $index => $image)
                                        @if ($index === 0)
                                            <div class='card-img'>
                                                <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}"
                                                    class="card-img-top" alt="...">
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="icons">
                                        <div class="d-flex">
                                            <form action="{{ route('home.create-like') }}" method="post"
                                                class="form form-inline">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <button type="submit"
                                                    class="btn btn-lg like-button {{ $post->isLiked($user->id) ? 'liked' : '' }}">
                                                    <i
                                                        class="{{ $post->isLiked($user->id) ? 'fas' : 'far' }} fa-heart heart-icon"></i>
                                                </button>
                                            </form>



                                            <button type="button" class="btn btn-lg">
                                                <a href="{{ route('posts.view', ['post_id' => $post->id]) }}">
                                                    <i class="far fa-comment"></i>
                                                </a>
                                            </button>
                                            <button type="button" class="btn btn-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                                                <defs>
                                                </defs>
                                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                                    <path d="M 31.121 43.543 c -0.852 0 -1.689 -0.362 -2.275 -1.042 L 0.727 9.836 C -0.051 8.934 -0.22 7.656 0.295 6.581 c 0.516 -1.074 1.607 -1.748 2.81 -1.7 l 84 2.952 c 1.356 0.047 2.513 1 2.817 2.324 c 0.306 1.323 -0.315 2.686 -1.515 3.323 l -55.88 29.712 C 32.083 43.429 31.6 43.543 31.121 43.543 z M 9.747 11.118 l 22.082 25.65 L 75.71 13.436 L 9.747 11.118 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path d="M 42.475 85.121 c -0.145 0 -0.291 -0.011 -0.437 -0.032 c -1.179 -0.173 -2.144 -1.027 -2.458 -2.178 L 28.226 41.333 c -0.37 -1.353 0.248 -2.781 1.486 -3.439 l 55.88 -29.712 c 1.196 -0.637 2.676 -0.39 3.602 0.603 c 0.927 0.993 1.07 2.484 0.352 3.636 L 45.019 83.71 C 44.466 84.596 43.5 85.121 42.475 85.121 z M 34.646 42.066 l 8.917 32.651 l 34.965 -55.983 L 34.646 42.066 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                </g>
                                                    </svg>   
                                                <!-- <i class="fas fa-share"></i> -->
                                            </button>
                                        </div>
                                        <div>
                                            <form action="{{ route('home.bookmark') }}" method="post"
                                                class="form form-inline">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                <button type="submit" class="btn btn-lg">
                                                    <i
                                                        class="{{ $post->isBookmarked($user->id) ? 'fas' : 'far' }} fa-bookmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="likes">
                                        <span style="font-weight:640; font-size:14px;">{{ $post->likes_count }} likes</span>
                                        <br />
                                        <small class="caption">
                                            <span class="mx-1"><b style="font-weight:640;">{{ $post->user->username }} </b></span>
                                                <span>{{ strlen($post->content) > 20 ? substr($post->content, 0, 20) . '...' : $post->content }}</span>
                                                <div class="comments">
                                                    <div class="comment">
                                                        <a href="{{ route('posts.view', ['post_id' => $post->id]) }}"
                                                            data-toggle="modal" data-target="#exampleModal">
                                                            View all {{ $post->comments_count }} comments
                                                        </a>
                                                    </div>
                                                </div>
                                        </small>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <form action="{{ route('home.create-comment') }}" method="POST"
                                                        class="form">
                                                        @csrf
                                                        <input type="hidden" name="post_id"
                                                            value="{{ $post->id }}">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <div class="form-row align-items-center flex-dir">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="content"
                                                                    id="commentInput" placeholder="Add a comment...">
                                                            </div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-primary btn-sm add-comment" id="postButton" style="display: none;">Post</button>
                                                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                                                <svg aria-label="Emoji" class="x1lliihq x1n2onr6 x1roi4f4 smile"
                                                                    fill="currentColor" height="20" role="img"
                                                                    viewBox="0 0 24 24" width="20">
                                                                    <title>Emoji</title>
                                                                    <path
                                                                        d="M15.83 10.997a1.167 1.167 0 1 0 1.167 1.167 1.167 1.167 0 0 0-1.167-1.167Zm-6.5 1.167a1.167 1.167 0 1 0-1.166 1.167 1.167 1.167 0 0 0 1.166-1.167Zm5.163 3.24a3.406 3.406 0 0 1-4.982.007 1 1 0 1 0-1.557 1.256 5.397 5.397 0 0 0 8.09 0 1 1 0 0 0-1.55-1.263ZM12 .503a11.5 11.5 0 1 0 11.5 11.5A11.513 11.513 0 0 0 12 .503Zm0 21a9.5 9.5 0 1 1 9.5-9.5 9.51 9.51 0 0 1-9.5 9.5Z">
                                                                    </path>
                                                                </svg>
                                                                </button>
                                                                
                                                                <ul class="dropdown-menu dropdown-menu-end" style="width: 180px;">
                                                                    <div class="row">
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😊</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">❤️</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">👍</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😂</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😍</a></div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2"><a class="dropdown-item" href="#">🤔</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😎</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">🤩</a></div>                                                                                                                            
                                                                        <div class="col-2"><a class="dropdown-item" href="#">🥰</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😳</a></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😋</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😜</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😇</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">🤗</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">🙄</a></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😉</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😚</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😛</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😘</a></div>
                                                                        <div class="col-2"><a class="dropdown-item" href="#">😴</a></div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr class="w-60 mb-0">
                    @endforeach

                </div>
            </div>
            <div class='col-3 suggest sticky-top '>
                <div class="sticky-top">
                    <div class="row">
                        <div class=" col-12 profile-bar p-3 d-flex justify-content-around align-items-center">
                            @php
                                if (Auth::user()->image) {
                                    $image =
                                        'https://res.cloudinary.com/dp3xwqpsq/image/upload/' .
                                        json_decode(Auth::user()->image);
                                }

                            @endphp
                            
                            <div class="media">
                                <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}">
                                    <img src="{{ Auth::user()->image ? $image : Auth::user()->avatar }}" class="mr-3 rounded-circle avatar-profile" alt="Avatar">
                                </a>
                                <div class="media-body d-flex align-items-center">
                                    <div>
                                        <h6 class="mt-0 mb-1">
                                            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}"
                                                class="user-name">{{ Auth::user()->username }}</a>
                                        </h6>
                                        <p class="text-muted mb-0">
                                            <a href="{{ route('profile.show', ['username' => Auth::user()->username]) }}"
                                                class="full-name">{{ Auth::user()->full_name }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-2">
                                <a href="#" class="btn btn pr-4 switch">Switch</a>
                            </div>
                        </div>
                    </div>

                    <div class="suggestions row">
                        <div class="d-flex justify-content-around align-items-center">
                            <span><p class="suggestions-title">Suggested For You</p></span>
                            <a href="{{ route('home.suggestions') }}"><p id="see-all">See All</p></a>
                        </div>
                        <div class="col-12 row" style="width:400px; padding-left:30px;">
                            @foreach ($suggestions as $key => $suggestion)
                                @if ($key < 5)
                                    <div class="row col-12" style="max-height: 60px; margin-left:5px;">
                                        <div
                                            class=" col-12 profile-bar p-3 d-flex justify-content-between align-items-center">
                                            @php
                                                if ($suggestion->image) {
                                                    $image =
                                                        'https://res.cloudinary.com/dp3xwqpsq/image/upload/' .
                                                        json_decode($suggestion->image);
                                                }

                                            @endphp
                                           
                            <div class="media">
                                <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}">
                                    <img src="{{ $suggestion->image ? $image : $suggestion->avatar }}" class="mr-3 rounded-circle avatar-profile" alt="Avatar">
                                </a>
                                <div class="media-body d-flex align-items-center">
                                    <div>
                                        <h6 class="mt-0 mb-1">
                                            <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}"
                                                class="user-name">{{ $suggestion->username }}</a>
                                        </h6>
                                        <p class="text-muted mb-0">Suggested for you</p>
                                    </div>
                                </div>
                            </div>                                      

                                            <div class="col-3">
                                            @php
                                                $isFollowingBack =
                                                    auth()->check() && auth()->user()->following->contains($suggestion);
                                            @endphp
                                            @if (auth()->check() && auth()->user()->id != $suggestion->id)
                                                @if ($isFollowingBack)
                                                    <form action="{{ route('profile.unfollow', $suggestion->username) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary px-4 follow-button">Unfollow</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('profile.follow', $suggestion->username) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary px-4 follow-button">Follow</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div> 
                                        </div>
                                    </div>
                    
                                @else
                                @break
                            @endif
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="{{ asset('js/home/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <script>
    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('scrollPosition', window.scrollY);
    });

    window.addEventListener('load', function() {
        var scrollPosition = sessionStorage.getItem('scrollPosition');
        if (scrollPosition) {
            setTimeout(function() {
                window.scrollTo(0, parseInt(scrollPosition));
            }, 0);
        }
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownToggleList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        dropdownToggleList.forEach(function(dropdownToggle) {
            new bootstrap.Dropdown(dropdownToggle);
        });
    });
    </script> 
@endsection
</body>

</html>
