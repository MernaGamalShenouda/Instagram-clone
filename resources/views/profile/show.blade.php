<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/profile_view.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- User info -->
        <div class="profile-header">
            <img src="{{ $user->avatar }}" alt="Avatar" class="profile-avatar">
            <div class="profile-details">
                <div class="d-flex align-items-center">
                    <h1>{{ $user->username }}</h1>
                    @if (auth()->check() && auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" class="edit-button ml-3">Edit profile</a>
                    @endif
                </div>
                <div class="profile-stats">
                    <div><strong>{{ $user->posts()->count() }}</strong> posts</div>
                    <div><strong>{{ $user->followers()->count() }}</strong> <a href="#" data-toggle="modal" data-target="#followersModal">followers</a></div>
                    <div><strong>{{ $user->following()->count() }}</strong> <a href="#" data-toggle="modal" data-target="#followingModal">following</a></div>

                </div>
                <div class="profile-bio">
                    <p><strong>{{ $user->full_name }}</strong></p>
                    <p>{{ $user->bio }}</p>
                    <p><a href="{{ $user->website }}">{{ $user->website }}</a></p>
                </div>
            </div>
            <!-- follow/unfollow/follow back handling -->
            @if (auth()->check() && auth()->user()->id != $user->id)
                @if (auth()->user()->following->contains($user))
                    <form action="{{ route('profile.unfollow', $user->username) }}" method="POST">
                        @csrf
                        <button class="follow-button">Unfollow</button>
                    </form>
                @else
                    @if ($isFollowingBack)
                        <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                            @csrf
                            <button class="follow-button">Follow back</button>
                        </form>
                    @else
                        <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                            @csrf
                            <button class="follow-button">Follow</button>
                        </form>
                    @endif
                @endif
            @endif
        </div>

        <!-- followers modal -->
        <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followersModalLabel">Followers</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="followersList"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- following modal -->
        <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followingModalLabel">Following</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="followingList"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs if the user is authenticated -->
        @if (auth()->check() && auth()->user()->id === $user->id)
            <div class="tab-container">
                <div class="tab active" id="postsTab" onclick="toggleTab('postsTab', 'postsContent')">Posts</div>
                <div class="tab" id="savedTab" onclick="toggleTab('savedTab', 'savedContent')">Saved</div>
            </div>
        @endif

        <!-- Content -->
        @if (auth()->check() && auth()->user()->id === $user->id)
            <!-- Posts and Saved Posts for authenticated users -->
            <div class="tab-content active" id="postsContent">
                <!-- Display Posts -->
                <div class="row post-grid">
                    @foreach($user->posts as $post)
                        <div class="col-md-4 mb-1">
                            <a href="/instagram/p/{{ $post->id }}">
                                <div class="card post-card">
                                    <img class="card-img-top" src="{{ $post->images }}" alt="Post Image">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-content" id="savedContent">
                <!-- Display Saved Posts -->
                <div class="row saved-post-grid">
                    @foreach($user->savedPosts as $savedPost)
                        <div class="col-md-4 mb-1">
                            <a href="{{ route('posts.view', $savedPost->post->id) }}">
                                <div class="card post-card">
                                    <img class="card-img-top" src="{{ $savedPost->post->images }}" alt="Post Image">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else

            <!-- Posts only for non-authenticated users -->
            <div class="row post-grid">
                @foreach($user->posts as $post)
                    <div class="col-md-4 mb-1">
                        <a href="/instagram/p/{{ $post->id }}">
                            <div class="card post-card">
                                <img class="card-img-top" src="{{ $post->images }}" alt="Post Image">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>

        // handle tabs
        function toggleTab(tabId, contentId) {
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            document.getElementById(contentId).classList.add('active');
        }

        // get Followers List
        $('#followersModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                $.get('{{ route("profile.followers", $user->username) }}', function(data) {
                    $('#followersList').html(data);
                });
            });

        // get Following List
        $('#followingModal').on('show.bs.modal', function (event) {
            var modal = $(this);
            $.get('{{ route("profile.following", $user->username) }}', function(data) {
                $('#followingList').html(data);
            });
        });

    </script> 
</body>
</html>
