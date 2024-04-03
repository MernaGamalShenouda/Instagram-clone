<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instagram</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>
    <div class='row'>
        <div class='col-2'></div>
        <div class='col-7'>
            <div class="container">
                <div class="row story-circles">
                    <div class="col-1 story">
                        <div class="story-circle">
                            <img src="https://via.placeholder.com/200x200" alt="User 1" class="img-fluid">
                        </div>
                        <p>.... </p>
                    </div>
                    <div class="col-1 story">
                        <div class="story-circle">
                            <img src="https://via.placeholder.com/200x200" alt="User 1" class="img-fluid">
                        </div>
                        <p>.... </p>
                    </div>

                    <!-- Add more columns for additional story circles -->
                </div>
            </div>
            <div class="container-posts">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <img src="{{ $post->user->avatar }}"
                                            alt="{{ $post->user->username }}" class="img-fluid">
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
                                <img src="{{ asset('images/home/' . $post->images) }}" class="card-img-top"
                                    alt="...">
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
                                                <i class="{{ $post->isBookmarked($user->id) ? 'fas' : 'far' }} fa-bookmark"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="likes">
                                    <span>{{ $post->likes_count }} likes</span>
                                    <br />
                                    <small class="text-muted">
                                        <span class="mx-1"><b>{{ $post->user->username }} </b></span>
                                        <span>{{ substr($post->content, 0, 20) }}..</span>
                                        <div class="comments">
                                            <div class="comment">
                                                <a href="#" data-toggle="modal" data-target="#exampleModal">
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
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $post->user->id }}">
                                                    <div class="form-row align-items-center flex-dir">
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="content"
                                                                id="commentInput" placeholder="Add a comment...">
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm add-comment"
                                                                id="postButton" style="display: none;">
                                                                Post
                                                            </button>
                                                            <i class="fa-regular fa-face-grin"></i>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class='col-3'></div>
                    </div>
                @endforeach
                <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
                <script src="{{ asset('js/home/home.js') }}"></script>
</body>

</html>
