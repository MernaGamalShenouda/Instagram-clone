@extends('layouts.admin')
@section('title', 'Index Page')

@section('content')
    <div class="container mt-5">
        <h1>Show Post</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $post->id }}</p>
                <p class="card-text"><strong>Content:</strong> {{ $post->content }}</p>
                <p class="card-text"><strong>User:</strong> {{ $post->user->username }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $post->created_at }}</p>
                <p class="card-text"><strong>Published At:</strong> {{ $post->published_at }}</p>
                @if($post->images)
                    <div class="row">
                        @php
                        $images = json_decode($post->images);
                        @endphp
                        @foreach($images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}" class="img-fluid" alt="Post Image">
                        </div>
                        @endforeach
                    </div>
                @endif

                <p class="card-text">
                    <strong>Comments count:</strong> 
                    {{ $post->comments_count }}
                    <ul>
                        @foreach ($post->comments as $comment)
                            <li>{{ $comment->user->username }}: {{ $comment->content }} </li>
                        @endforeach
                   </ul>
                </p>

                <p class="card-text">
                    <strong>Likes count:</strong> 
                    {{ $post->likes_count }}
                    <ul>
                        @foreach ($post->likes as $like)
                            @if ($like->user)
                                <li>{{ $like->user->username }}</li>
                            @endif
                        @endforeach
                    </ul>
                </p>

            </div>
        </div>
    </div>
@endsection
