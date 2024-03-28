<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/1409/1409946.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>
    <div class='row'>
        <div class='col-2'></div>
        <div class='col-7'>
            <div class="container">
                <div class="row story-circles">
                    <div class="col-1 story">
                        <div class="story-circle">
                            <img src="https://via.placeholder.com/200x200" alt="User 1" class="img-fluid">
                        </div>
                        <p>.... </p>
                    </div>
                    <div class="col-1 story">
                        <div class="story-circle">
                            <img src="https://via.placeholder.com/200x200" alt="User 1" class="img-fluid">
                        </div>
                        <p>.... </p>
                    </div>

                    <!-- Add more columns for additional story circles -->
                </div>
            </div>
            <div class="container-posts">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <img src="{{ $post->user->profile_image }}" alt="{{ $post->user->username }}"
                                            class="img-fluid">
                                    </div>
                                    <span class="username mx-2">{{ $post->user->username }}</span>
                                </div>
                                <button type="button" class="btn btn-sm rounded-circle ellipsis">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                            <div>
                                <img src="{{ $post->image }}" class="card-img-top" alt="...">
                                <div class="icons">
                                    <!-- Your existing code for icons -->
                                </div>
                                <small class="text-muted">Posted on: {{ $post->created_at->format('F j, Y') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class='col-3'></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script src="{{ asset('js/home/home.js') }}"></script>
</body>

</html>
