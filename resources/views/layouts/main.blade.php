@extends('layouts.sidebar')

@section('title', 'Profile')

@section('content')

    @yield ('profile_content')

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
                @foreach ($user->posts as $post)
                    <div class="col-md-4 mb-1">
                        <a href="/instagram/p/{{ $post->id }}">
                            <div class="card post-card">
                                <!-- <img class="card-img-top" src="{{ $post->images }}" alt="Post Image"> -->
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
        </div>

        <div class="tab-content" id="savedContent">
            <!-- Display Saved Posts -->
            <div class="row saved-post-grid">
                @foreach ($user->savedPosts as $savedPost)
                    <div class="col-md-4 mb-1">
                        <a href="{{ route('posts.view', $savedPost->post->id) }}">
                            <div class="card post-card">
                                <!-- <img class="card-img-top" src="{{ $savedPost->post->images }}" alt="Post Image"> -->
                                @php
                                    $images = json_decode($savedPost->post->images);
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
        </div>
    @else
        <!-- Posts only for non-authenticated users -->
        <div class="row post-grid">
            @foreach ($user->posts as $post)
                <div class="col-md-4 mb-1">
                    <a href="/instagram/p/{{ $post->id }}">
                        <div class="card post-card">
                            <!-- <img class="card-img-top" src="{{ $post->images }}" alt="Post Image"> -->
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
    @endif

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
        $('#followersModal').on('show.bs.modal', function(event) {
            var modal = $(this);
            $.get('{{ route('profile.followers', $user->username) }}', function(data) {
                $('#followersList').html(data);
            });
        });

        // get Following List
        $('#followingModal').on('show.bs.modal', function(event) {
            var modal = $(this);
            $.get('{{ route('profile.following', $user->username) }}', function(data) {
                $('#followingList').html(data);
            });
        });

        //Post_View Script

        function redirectToTagView(tag) {
            var url = "{{ route('tags.view', ['tag_id' => ':tag_id']) }}";
            url = url.replace(':tag_id', tag);
            window.location.href = url;
            console.log('Hello Tag');
        }
    </script>
    @yield ('post_scripts')
@endsection
