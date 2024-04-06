@extends('layouts.sidebar')

@section('title', '#' . $tag->name)

@section('content')
<div class="ms-5">

  <h2>#{{ $tag->name }}</h2>
  <h4>{{$tag->posts->count()}}</h4>
  <h5>posts</h5>
        
        <button class="btn btn-primary mb-4" style="width: 550px">Follow</button>

</div>
      
        <div class="row">
            <h5>Top posts</h5>
            @foreach($tag->posts as $post)
                <div class="col-md-4 mb-1 ps-1" >
                    <div class="card">
                        {{-- @dd($tag->posts) --}}
                        <img src="{{ json_decode($post->images)[0] }}" class="card-img-top" alt="{{ $post->user->username }}">
             
                    
                    </div>
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
