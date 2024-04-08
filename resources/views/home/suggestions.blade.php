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

        @yield ('home_content')
        <div class="col-10 m-5 suggested ">
            <div>
                <h6> Suggested: </h6>
            </div>
            <div class="container">
                @foreach ($suggestions as $suggestion)
                    <div class="row ">
                        <div class=" col-8 profile-bar p-3 d-flex justify-content-around align-items-center">
                            <div class=" col-9 d-flex justify-content-start align-items-center profile-details">
                                <div class="col-2">
                                    <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}">
                                        <img src="{{ $suggestion->avatar }}" class="rounded-circle profileImage"
                                            alt="Profile Image">
                                    </a>
                                </div>
                                <div class="px-3 col-10">
                                    <a href="{{ route('profile.show', ['username' => $suggestion->username]) }}">

                                        <div id="full_name"><b>{{ $suggestion->full_name }}</b></div>
                                        <div id="username">{{ $suggestion->username }}</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-3">
                                @php
                                    $isFollowingBack =
                                        auth()->check() && auth()->user()->following->contains($suggestion);
                                @endphp
                                @if (auth()->check() && auth()->user()->id != $suggestion->id)
                                    @if ($isFollowingBack)
                                        <form action="{{ route('profile.unfollow', $suggestion->username) }}"
                                            method="POST">
                                            @csrf
                                            <button class="btn btn-primary px-4 follow-button">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('profile.follow', $suggestion->username) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-primary px-4 follow-button">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
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
