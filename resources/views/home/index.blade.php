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
                    <div class="row story-circles">
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
                    </div>

                </div>
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

                                                <b>{{ $post->user->username }}</b>
                                            </span>
                                        </a>
                                        <span>
                                            {{ $post->created_at ? $post->created_at->diffForHumans(null, true) : '' }}</span>
                                    </div>
                                    <button type="button" class="btn btn-sm rounded-circle ellipsis">
                                        <i class="fas fa-ellipsis-h"></i>
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
                                                    class="btn btn-sm like-button {{ $post->isLiked($user->id) ? 'liked' : '' }}">
                                                    <i
                                                        class="{{ $post->isLiked($user->id) ? 'fas' : 'far' }} fa-heart"></i>
                                                </button>
                                            </form>



                                            <button type="button" class="btn btn-sm">
                                                <a href="{{ route('posts.view', ['post_id' => $post->id]) }}">
                                                    <i class="far fa-comment"></i>
                                                </a>
                                            </button>
                                            <button type="button" class="btn btn-sm">
                                                <i class="fas fa-share"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <form action="{{ route('home.bookmark') }}" method="post"
                                                class="form form-inline">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                <button type="submit" class="btn btn-sm">
                                                    <i
                                                        class="{{ $post->isBookmarked($user->id) ? 'fas' : 'far' }} fa-bookmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="likes">
                                        <span>{{ $post->likes_count }} likes</span>
                                        <br />
                                        <small class="text-muted">
                                            <spa n class="mx-1"><b>{{ $post->user->username }} </b></span>
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
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm add-comment"
                                                                    id="postButton" style="display: none;">Post</button>
                                                                <button class="btn dropdown-toggle" type="button"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    😊 <!-- Default emoji icon -->
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">😊</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#">❤️</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#">👍</a>
                                                                    </li>
                                                                    <!-- Add more emoji items as needed -->
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
                                <a href="#" class="btn btn pr-4" style="margin-left:-20px;">Switch</a>
                            </div>
                        </div>
                    </div>

                    <div class="suggestions row">
                        <div class="d-flex justify-content-around align-items-center">
                            <span><b>Suggestions For You</b></span>
                            <a href="{{ route('home.suggestions') }}"><b>See All</b></a>
                        </div>
                        <div class="col-12 row" style="width:400px; padding-left:30px;">
                            @foreach ($suggestions as $key => $suggestion)
                                @if ($key < 5)
                                    <div class="row col-12">
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
                                        <p class="text-muted mb-0">
                                            <a href="{{route('profile.show', ['username' => $suggestion->username]) }}"
                                                class="full-name">{{ $suggestion->full_name }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>                                      

                                            
                                            <!-- <div class="col-2">
                                                <a href="#" class="btn btn pr-4">Follow</a>
                                            </div> -->

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
    </script> 
@endsection
</body>

</html>
