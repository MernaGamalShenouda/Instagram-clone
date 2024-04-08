@extends('layouts.sidebar')

@section('title', '#' . $tag->name)

@section('content')
    <div class="ms-5">

    <h2>#{{ $tag->name }}</h2>
    <h4>{{$tag->posts->count()}}</h4>
    <h5>posts</h5>
            <button class="btn btn-primary mb-4" style="width: 550px">Follow</button>
    </div>
    
    <div class="row post-grid">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-1">
                <a href="/instagram/p/{{ $post->id }}">
                    <div class="card post-card">
                        @php
                            $images = json_decode($post->images);
                        @endphp
                        @foreach ($images as $index => $image)
                            @if ($index === 0)
                                <div class='card-img'>
                                    <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}"
                                    class="d-block img-fluid " alt="Post Image">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    @parent
    <style>
        .card {
            transition: transform 0.2s;
        
        }

        .card:hover {
            transform: scale(1.05);
        }
  
    </style>
@endsection
