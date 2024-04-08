@extends('layouts.admin')
@section('title', 'Show Post')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Show Post</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>ID:</strong> {{ $post->id }}</p>
            <p class="card-text"><strong>Content:</strong> {{ $post->content }}</p>
            <p class="card-text"><strong>User:</strong> {{ $post->user->username }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $post->created_at }}</p>
            <p class="card-text"><strong>Published At:</strong> {{ $post->published_at }}</p>

            <!-- Display images -->
            @if($post->images)
            <div class="row">
                @php $images = json_decode($post->images); @endphp
                @foreach($images as $image)
                <div class="col-md-4 mb-3">
                    <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}" class="img-fluid" alt="Post Image">
                </div>
                @endforeach
            </div>
            @endif

            <!-- Comments section -->
            <p class="card-text"><strong>Comments count:</strong> {{ $post->comments_count }}</p>
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                <li class="list-group-item">{{ $comment->user->username }}: {{ $comment->content }}</li>
                @endforeach
            </ul>

            <!-- Likes section -->
            <p class="card-text mt-3"><strong>Likes count:</strong> {{ $post->likes_count }}</p>
            <ul class="list-group">
                @foreach ($post->likes as $like)
                @if ($like->user)
                <li class="list-group-item">{{ $like->user->username }}</li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
