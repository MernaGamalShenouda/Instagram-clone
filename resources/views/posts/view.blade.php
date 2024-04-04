<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Post - Instagram</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
=======
    <title>View Post - Instagram</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Custom CSS -->
>>>>>>> c70bb595ba263d60e37211ff79133f268b2f92c8
     <link href="{{ asset('css/posts/post_view.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#postModal">
        View Post
    </button>

    <!-- Modal -->
<<<<<<< HEAD
    <div class="modal fade border-0" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="row g-0 card-outer-body">
                                    <div class="col-md-6 d-flex align-items-center postImg-section">
                                         <img src="{{ asset($post->images) }}" class="img-fluid rounded w-100" alt="Post Image">
                                    </div>
                                    <div class="col-md-6 d-flex flex-column justify-content-between align-items-start">
                                       <!-- User Info  -->
                                       <div class="border col-md-12 post-userInfo-section">
                                            <div class="post-userInfo-content">
                                                <img src="{{ $post->user->avatar }}" class="img-fluid rounded avatar-image" alt="User Avatar">
                                                <div>
                                                    <p class="username"><strong>{{ $post->user->username }}</strong></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Body  -->
                                        <div class="card-body col-md-12">
                                            <p><strong>ID:</strong> {{ $post->id }}</p>
                                            <p><strong>Body:</strong> {{ $post->content }}</p>
                                            <p><strong>Image:</strong> {{ $post->images }}</p>
                                            <div id='commentsContainer'> 
                                                @foreach($comments as $comment)
                                                    <p><strong>Comment:</strong> {{ $comment->content }}</p>
                                                @endforeach  
                                            </div>                                          
                                            <p><strong>Published At:</strong> {{ $post->published_at }}</p>
                                        </div>

                                        <!-- Comments & Likes -->
                                        <div class="border col-md-12 post-likes-section d-flex flex-column align-items-center">
                                            <!-- Div containing the icons -->
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <div class="d-flex align-items-center">
                                                    <!-- Heart icon (not filled) -->
                                                    <button type="button" class="btn btn-link btn-lg btn-black px-0">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                    <!-- Comment icon -->
                                                    <button type="button" class="btn btn-link btn-lg btn-black">
                                                        <i class="far fa-comment"></i>
                                                    </button>
                                                </div>

                                                <!-- Bookmark icon -->
                                                <div>
                                                    <button type="button" class="btn btn-link btn-lg btn-black px-0">
                                                        <i class="far fa-bookmark"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Div for Comments and Likes Info -->
                                            <div class='w-100'>
                                                Comments and Likes Info 
                                            </div>
                                        </div>

                                        <!-- Add Comment -->
                                        <div class="col-md-12 post-input-section"> 
                                            <form method="POST" action="{{ route('posts.storeComment') }}" id='commentForm'>
                                                @csrf <!-- CSRF token -->
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                                                <input type="hidden" name="updated_at" id="updated_at">
                                                <input type="hidden" name="created_at" id="created_at">

                                                <div class="input-group border">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        😊 <!-- Default emoji icon -->
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">😊</a></li>
                                                        <li><a class="dropdown-item" href="#">❤️</a></li>
                                                        <li><a class="dropdown-item" href="#">👍</a></li>
                                                        <!-- Add more emoji items as needed -->
                                                    </ul>
                                                    <input type="text" class="form-control border-0" name="content" placeholder="Add a comment...">
                                                    <button class="btn custom-btn" type="submit">Post</button> <!-- Submit button -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
=======
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Show Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            @if($post->image)
                                <div class="post-image">
                                    <img src="{{ asset($post->image) }}" class="img-fluid rounded" alt="Post Image">
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <p><strong>ID:</strong> {{ $post->id }}</p>
                            <p><strong>Body:</strong> {{ $post->body }}</p>
                            <p><strong>User:</strong> {{ $post->user_id }}</p>
                            <p><strong>Likes:</strong> {{ $post->likes }}</p>
                            <p><strong>Comments:</strong> {{ $post->comments }}</p>
                            <p><strong>Published At:</strong> {{ $post->published_at }}</p>
>>>>>>> c70bb595ba263d60e37211ff79133f268b2f92c8
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<<<<<<< HEAD
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var comments = {!! json_encode($comments) !!};
    // console.log('comments',comments);

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
                // console.log('Form submitted successfully');

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
        commentElement.innerHTML = `<strong>Comment:</strong> ${newComment.content}`;
        commentsContainer.appendChild(commentElement);
    }

    document.getElementById('commentForm').addEventListener('submit', submitForm);
</script>

=======
    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> c70bb595ba263d60e37211ff79133f268b2f92c8
</body>
</html>
