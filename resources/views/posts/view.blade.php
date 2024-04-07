
@extends('layouts.main')

@section('title','Profile')

@section('profile_content')
                            <div class="card post-view-card">
                                <div class="row g-0 card-outer-body">
                                    <div class="col-md-6 d-flex align-items-center postImg-section">
                                        <div id="carouselExampleIndicators" class="carousel slide"
                                            data-bs-interval="false">
                                            <div class="carousel-inner">
                                                @php

                                                    $images = json_decode($post->images);

                                                @endphp
                                                @foreach ($images as $index => $image)
                                                    <div class="carousel-item w-100 h-100 {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}"
                                                            class="d-block h-100 w-100 img-fluid"  alt="Post Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if (count($images) > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                                <ol class="carousel-indicators">
                                                    @foreach ($images as $index => $image)
                                                        <li data-bs-target="#carouselExampleIndicators"
                                                            data-bs-slide-to="{{ $index }}"
                                                            class="{{ $index === 0 ? 'active' : '' }}"></li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex flex-column justify-content-between align-items-start">
                                        <!-- User Info  -->
                                        <div class="border col-md-12 post-userInfo-section">
                                            <div class="post-userInfo-content">
                                                <img src="{{ $post->user->avatar }}"
                                                    class="img-fluid rounded avatar-image" alt="User Avatar">
                                                <div>
                                                    <p class="username"><strong>{{ $post->user->username }}</strong></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Body  -->
                                        <div class="card-body col-md-12">
                                            <div class="p-0 m-0 col-md-12 post-userInfo-section">
                                                <div class="post-userInfo-content">
                                                    <div>
                                                        <p class=""><strong class="me-1">{{ $post->user->username }}:</strong>
                                                            {!! preg_replace('/#(\w+)/', '<a href="javascript:void(0);" onclick="redirectToTagView(\'$1\')">#$1</a>', $post->content) !!}
                                                         </p>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div id='commentsContainer' class="p-0 m-0">
                                                @foreach ($comments as $comment)
                                                    <p><strong>{{ $comment->user->username }}:</strong>
                                                        {{ $comment->content }}</p>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Comments & Likes -->
                                        <div
                                            class="border col-md-12 post-likes-section d-flex flex-column align-items-center">
                                            <!-- Div containing the icons -->
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <!-- Heart icon -->
                                                    <form id="like-form" action="{{ route('post.create-like') }}" method="post" class="form form-inline">
                                                        @csrf
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-lg like-button {{ $post->isLiked($user->id) ? 'liked' : '' }}">
                                                            <i class="{{ $post->isLiked($user->id) ? 'fas' : 'far black-heart' }} fa-heart"></i>
                                                        </button>
                                                    </form>
                                                    <!-- Comment icon -->
                                                    <button type="button" class="btn btn-link btn-lg btn-black">
                                                        <i class="far fa-comment"></i>
                                                    </button>
                                                </div>

                                                <!-- Bookmark icon -->
                                                <div>
                                                    <form id="bookmark-form" action="{{ route('post.bookmark') }}" method="post"
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

                                            <!-- Div for Comments and Likes Info -->
                                            <div id="post-info" class='w-100'>
                                                <strong> <span class='Likes'>{{$post->likes_count}}</span> Likes </strong>
                                                <strong> <span class='Comments'>{{$post->comments_count}}</span> Comments </strong>
                                            </div>
                                        </div>

                                        <!-- Add Comment -->
                                        <div class="col-md-12 post-input-section">
                                            <form method="POST" action="{{ route('posts.storeComment') }}"
                                                id='commentForm'>
                                                @csrf <!-- CSRF token -->
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="updated_at" id="updated_at">
                                                <input type="hidden" name="created_at" id="created_at">

                                                <div class="input-group border">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        😊 <!-- Default emoji icon -->
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">😊</a></li>
                                                        <li><a class="dropdown-item" href="#">❤️</a></li>
                                                        <li><a class="dropdown-item" href="#">👍</a></li>
                                                        <!-- Add more emoji items as needed -->
                                                    </ul>
                                                    <input type="text" class="form-control border-0"
                                                        name="content" placeholder="Add a comment...">
                                                    <input type="text" class="form-control border-0"
                                                        name="username" hidden value="{{ $user->username }}">
                                                    <button class="btn custom-btn" type="submit">Post</button>
                                                    <!-- Submit button -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endsection


@section('post_script')
<script> 
    var comments = {!! json_encode($comments) !!};

    function getCurrentDateTime() {
        return new Date().toISOString();
    }

    function submitForm(event) {
        event.preventDefault(); 
        var formData = new FormData(event.target);
        
        formData.set('updated_at', getCurrentDateTime());
        formData.set('created_at', getCurrentDateTime());
        
        // Perform AJAX request
        fetch(event.target.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                var commentContent = event.target.querySelector('[name="content"]').value;
                var newComment = { content: commentContent };

                fetchComments(newComment);
                event.target.querySelector('[name="content"]').value = ''; // Clear the input value
            } else {
                console.error('Form submission failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function fetchComments(newComment) {
        var commentsContainer = document.getElementById('commentsContainer');
        var commentElement = document.createElement('p');
        var currentComments = parseInt($('.Comments').text());
        $('.Comments').text(currentComments+1);

        commentElement.innerHTML = `<strong>{{ $user->username }}:</strong> ${newComment.content}`;
        commentsContainer.appendChild(commentElement);
    }

    document.getElementById('commentForm').addEventListener('submit', submitForm);

    $(document).ready(function() {
        $('#like-form').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    var likeButton = $('#like-form').find('.like-button');
                    likeButton.toggleClass('liked');
                    likeButton.find('.fa-heart').toggleClass('fas black-heart').toggleClass('far');

                    var currentLikes = parseInt($('.Likes').text());
                    if (likeButton.hasClass('liked')) {
                        $('.Likes').text(currentLikes+1);
                    } else {
                        $('.Likes').text(currentLikes-1);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        // Bookmark form submission
        $('#bookmark-form').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    var bookmarkButton = $('#bookmark-form').find('.btn-lg');
                    bookmarkButton.find('.fa-bookmark').toggleClass('fas far');

                    // Optionally, you can update UI or perform other actions upon success
                    console.log('Bookmark action success');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function redirectToTagView(tag) {
        var url = "{{ route('tags.view', ['tag_id' => ':tag_id']) }}";
        url = url.replace(':tag_id', tag);
        window.location.href = url;
    }

</script>

@endsection

