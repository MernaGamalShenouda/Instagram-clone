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
    @extends('layouts.sidebar')

    @section('title', 'Instagram')

    @section('content')

        @yield ('home_content')
        <div class="row ">
            <div class='col-9'>
                <div class="row">
                    <div class="row story-circles">
                        <div class="col-1 story">
                            <div class="story-circle">
                                <img src="{{ asset('images\home\stories\flower.jpg') }}" alt="User 1" class="img-fluid">
                            </div>
                            <p>use1</p>
                        </div>
                        <div class="col-1 story">
                            <div class="story-circle">
                                <img src="{{ asset('images\home\stories\Spider.jpeg') }}" alt="User 2" class="img-fluid">
                            </div>
                            <p>user2 </p>
                        </div>
                        <div class="col-1 story">
                            <div class="story-circle">
                                <img src="{{ asset('images\home\stories\Hacker.jpeg') }}" alt="User 3" class="img-fluid">
                            </div>
                            <p>user3 </p>
                        </div>
                        <div class="col-1 story">
                            <div class="story-circle">
                                <img src="{{ asset('images\home\stories\girl.jpeg') }}" alt="User 4" class="img-fluid">
                            </div>
                            <p>user4</p>
                        </div>
                        <div class="col-1 story">
                            <div class="story-circle">
                                <img src="{{ asset('images\home\stories\Tom.jpeg') }}" alt="User 5" class="img-fluid">
                            </div>
                            <p>user5</p>
                        </div>
                    </div>
                </div>
                <div class="container-posts">
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->username }}"
                                                class="img-fluid">
                                        </div>
                                        <span class="username mx-2">
                                            <b>{{ $post->user->username }}</b>
                                        </span>
                                        <span>
                                            {{ $post->created_at->diffForHumans(null, true) }}</span>
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
                                                <i class="far fa-comment"></i>
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
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal">
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
                                                            value="{{ $user->id }}">
                                                        <div class="form-row align-items-center flex-dir">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="content"
                                                                    id="commentInput" placeholder="Add a comment...">
                                                            </div>
                                                            <div class="col-auto">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm add-comment"
                                                                    id="postButton" style="display: none;">Post</button>
                                                                <button class="trigger"><i
                                                                        class="fa-regular fa-face-grin"></i>
                                                                </button>
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
            <div class='col-3 suggest'>
                <div class="sticky-top">

                    <div class="row">
                        <div class=" col-12 profile-bar p-3 d-flex justify-content-around align-items-center">

                            <div class=" col-9 d-flex justify-content-start align-items-center">
                                <div class="col-5">
                                    <img src="{{ asset($user->avatar) }}" class="rounded-circle profileImage"
                                        alt="Profile Image">
                                </div>
                                <div class="px-3 col-7">
                                    <div id="full_name">
                                        <h6>{{ $user->full_name }}</h6>
                                    </div>
                                    <div id="username">{{ $user->username }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <a href="#" class="btn btn px-4">Switch</a>
                            </div>
                        </div>
                    </div>

                    <div class="suggestions mt-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Suggestions For You</span>
                            <a href="{{ route('home.suggestions') }}">See All</a>
                        </div>
                        <div class="container">
                            @foreach ($suggestions as $key => $suggestion)
                                @if ($key < 5)
                                    <div class="row ">
                                        <div
                                            class=" col-10 profile-bar p-3 d-flex justify-content-around align-items-center">

                                            <div class=" col-9 d-flex justify-content-start align-items-center">
                                                <div class="col-4">
                                                    <img src="{{ $suggestion->avatar }}"
                                                        class="rounded-circle profileImage" alt="Profile Image">
                                                </div>
                                                <div class="px-3 col-8">
                                                    <div id="full_name"><b>{{ $suggestion->full_name }}</b></div>
                                                    <div id="username">{{ $suggestion->username }}</div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <a href="#" class="btn px-4">Follow</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4/dist/emoji-button.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="{{ asset('js/home/home.js') }}"></script>
    <script src="{{ asset('js/home/emojy.js') }}"></script>
@endsection
</body>

</html>
