<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post - Instagram</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Custom CSS -->
     <link href="{{ asset('css/posts/post_view.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#postModal">
        View Post
    </button>

    <!-- Modal -->
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
