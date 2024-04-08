@extends('layouts.admin')
@section('title', 'Index Page')

@section('content')
    <div class="container mt-5">
        <h1>Show User</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
                <p class="card-text"><strong>Name:</strong> {{ $user->username }}</p>
                <p class="card-text"><strong>Full Name:</strong> {{ $user->full_name }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Gender:</strong> {{ $user->gender }}</p>
                <p class="card-text"><strong>Website:</strong> {{ $user->website }}</p>
                <p class="card-text"><strong>Bio:</strong> {{ $user->bio }}</p>

                <p class="card-text">
                    <strong>Following:</strong> 
                    <ul>
                        @foreach ($user->following as $followee)
                            <li>{{ $followee->username }}</li>
                        @endforeach
                    </ul>
                </p>

                
                <p class="card-text">
                    <strong>Followers:</strong> 
                    <ul>
                        @foreach ($user->followers as $follower)
                            <li>{{ $follower->username }}</li>
                        @endforeach
                    </ul>
                </p>


                <strong>Avatar:</strong> 
                <div class="col-md-4 mb-3">
                    <img src="{{ $user->avatar }}" class="img-fluid" alt="Post Image">
                </div>

            </div>
        </div>
    </div>
@endsection
