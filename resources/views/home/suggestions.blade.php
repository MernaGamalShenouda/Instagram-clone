<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>
    @extends('layouts.sidebar')

    @section('title', 'Instagram')

    @section('content')

      
            <div class="container">
            <div class="col-8 m-5">
            <div>
                <h6 class="col-12 offset-4"> Suggested </h6>
            </div>
                @foreach ($suggestions as $key => $suggestion)
    @if ($key < 100)
        <div class="row col-12" style="max-height: 65px; margin-left:5px;">
            <div class="col-12 offset-4 profile-bar p-3 d-flex justify-content-between align-items-center">
                @php
                    if ($suggestion->image) {
                        $image =
                            'https://res.cloudinary.com/dp3xwqpsq/image/upload/' .
                            json_decode($suggestion->image);
                    }
                @endphp
                <div class="media">
                    <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}">
                        <img src="{{ $suggestion->image ? $image : $suggestion->avatar }}" class="mr-3 rounded-circle avatar-profile" alt="Avatar">
                    </a>
                    <div class="media-body d-flex align-items-center">
                        <div>
                            <h6 class="mt-0 mb-1">
                                <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}" class="user-name">{{ $suggestion->username }}</a>
                            </h6>
                            <p class="text-muted mb-0">Suggested for you</p>
                        </div>
                    </div>
                </div>                                      
                <div class="col-3">
                    @php
                        $isFollowingBack = auth()->check() && auth()->user()->following->contains($suggestion);
                    @endphp
                    @if (auth()->check() && auth()->user()->id != $suggestion->id)
                        @if ($isFollowingBack)
                            <form action="{{ route('profile.unfollow', $suggestion->username) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary px-4 follow-button">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('profile.follow', $suggestion->username) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary px-4" style="background-color: #0095f6 !important; padding:5px 18px !important; font-size:14px; font-weight:500;">Follow</button>
                            </form>
                        @endif
                    @endif
                </div> 
            </div>
        </div>
    @else
        @break
    @endif
@endforeach

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4/dist/emoji-button.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
        <script src="{{ asset('js/home/home.js') }}"></script>
        <script src="{{ asset('js/home/emojy.js') }}"></script>
    @endsection
</body>

</html>
