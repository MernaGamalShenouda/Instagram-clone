@extends('layouts.admin')
@section('title', 'Show User')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Show User</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Name:</strong> {{ $user->username }}</p>
            <p class="card-text"><strong>Full Name:</strong> {{ $user->full_name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Gender:</strong> {{ $user->gender }}</p>
            <p class="card-text"><strong>Website:</strong> {{ $user->website }}</p>
            <p class="card-text"><strong>Bio:</strong> {{ $user->bio }}</p>

            <p class="card-text"><strong>Following:</strong></p>
            <ul class="list-group">
                @foreach ($user->following as $followee)
                <li class="list-group-item">{{ $followee->username }}</li>
                @endforeach
            </ul>

            <p class="card-text mt-3"><strong>Followers:</strong></p>
            <ul class="list-group">
                @foreach ($user->followers as $follower)
                <li class="list-group-item">{{ $follower->username }}</li>
                @endforeach
            </ul>

            <p class="card-text mt-3"><strong>Avatar:</strong></p>
            <div class="col-md-4 mb-3 mx-auto">
                <img src="{{ $user->avatar }}" class="img-fluid rounded-circle" alt="User Avatar">
            </div>
        </div>
    </div>
</div>
@endsection
