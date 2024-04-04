<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-avatar {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .profile-details {
            margin-left: 20px;
            flex-grow: 1;
        }
        .profile-details h1 {
            margin-top: 0;
            font-size: 28px;
        }
        .profile-stats {
            display: flex;
            margin-top: 10px;
        }
        .profile-stats div {
            margin-right: 20px;
            font-size: 16px;
        }
        .profile-bio {
            margin-top: 20px;
            font-size: 16px;
        }
        .edit-button, .follow-button {
            padding: 10px 20px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <img src="{{ $user->avatar }}" alt="Avatar" class="profile-avatar">
            <div class="profile-details">
                <div class="d-flex align-items-center">
                    <h1>{{ $user->username }}</h1>
                    @if (auth()->check() && auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" class="edit-button ml-3">Edit</a>
                    @endif
                </div>
                <div class="profile-stats">
                    <div><strong>{{ $user->posts()->count() }}</strong> posts</div>
                    <div><strong>{{ $user->followers()->count() }}</strong> followers</div>
                    <div><strong>{{ $user->following()->count() }}</strong> following</div>
                </div>
                <div class="profile-bio">
                    <p><strong>{{ $user->full_name }}</strong></p>
                    <p>{{ $user->bio }}</p>
                    <p><a href="{{ $user->website }}">{{ $user->website }}</a></p>
                </div>
            </div>
            @if (auth()->check() && auth()->user()->id != $user->id)
                @if (auth()->user()->following->contains($user))
                    <form action="{{ route('profile.unfollow', $user->username) }}" method="POST">
                        @csrf
                        <button class="follow-button">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                        @csrf
                        <button class="follow-button">Follow</button>
                    </form>
                @endif
            @endif
        </div>
        <!-- <div class="tabs-container">
            <div class="tabs">
                <div class="tab active">Posts</div>
                <div class="tab">Saved</div>
            </div>
        </div> -->
        <div class="post-grid">
            @foreach($user->posts as $post)
                <a href="/instagram/p/{{ $post->id }}">
                    <img src="{{ $post->image }}" alt="Post Image">
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
