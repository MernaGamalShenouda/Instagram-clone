<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home/search.css') }}">

</head>

<body>
    @extends('layouts.sidebar')

    @section('title', 'Search')

    @section('content')

        @yield('search_content')
        <div class="search ">
            <div class='col-9'>
                <div class="row">
                    <form action="{{ route('home.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputGroupFile04" name="search">
                            <button class="btn " type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>


                    <div>
                        @if (isset($results) && count($results) > 0)
                            @foreach ($results as $result)
                                <div class="row ">
                                    <div class=" col-8 profile-bar p-3 d-flex justify-content-around align-items-center">
                                        <div class=" col-9 d-flex justify-content-start align-items-center profile-details">

                                            <div class="col-2">
                                                <a href="{{ route('profile.show', ['username' => $result->username]) }}">
                                                    @php
                                                    $image="https://res.cloudinary.com/dp3xwqpsq/image/upload/".json_decode($result->image);
                                                    @endphp
                                                    <img src="{{ $result->image ? $image : $result->avatar }}" class="rounded-circle profileImage"
                                                        alt="Profile Image">
                                                </a>
                                            </div>
                                            <div class="px-3 col-10">
                                                <a href="{{ route('profile.show', ['username' => $result->username]) }}">

                                                    <div id="full_name"><b>{{ $result->full_name }}</b></div>
                                                    <div id="username">{{ $result->username }}</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a href="#" class="btn btn-primary px-4" style="color:white">Follow</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No results found.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endsection
</body>

</html>
