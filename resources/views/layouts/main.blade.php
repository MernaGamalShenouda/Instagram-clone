@extends('layouts.sidebar')

@section('title', $user->full_name)

@section('content')

    <div class="container">
        @yield ('profile_content')
    </div>

   
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-11 justify-content-center offset-md-1">
                <hr class="w-100 mb-2">
                <!-- Tabs for authenticated user -->
                @if (auth()->check() && auth()->user()->id === $user->id)
                    <div class="tab-container col-md-12">
                        <i class="bi bi-grid-3x2-gap-fill" id="postsIcon" onclick="toggleTab('postsTab', 'postsContent', 'postsIcon')"></i>
                        <div class="tab active" id="postsTab" onclick="toggleTab('postsTab', 'postsContent', 'postsIcon')">POSTS</div>
                        <i class="bi bi-bookmark" id="savedIcon" onclick="toggleTab('savedTab', 'savedContent', 'savedIcon')"></i>
                        <div class="tab" id="savedTab" onclick="toggleTab('savedTab', 'savedContent', 'savedIcon')">SAVED</div>
                    </div>
                @endif

                <!-- Content -->
                @if (auth()->check() && auth()->user()->id === $user->id)
                    <!-- Posts and Saved Posts for authenticated user -->
                    <div class="tab-content active" id="postsContent">
                        <!-- Display Posts -->
                        <div class="row post-grid">
                            @foreach ($user->posts->reverse() as $post)
                                <div class="col-md-4 mb-1">
                                    <a href="/instagram/p/{{ $post->id }}">
                                        <div class="card post-card">
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
                            @foreach ($user->savedPosts->reverse() as $savedPost)
                                <div class="col-md-4 mb-1">
                                    <a href="{{ route('posts.view', $savedPost->post->id) }}">
                                        <div class="card post-card">
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
                    </div>
                @else
                    <!-- Posts only for non-authenticated users -->
                    <div class="tab-container col-md-12">
                        <i class="bi bi-grid-3x2-gap-fill" id="postsIcon" onclick="toggleTab('postsTab', 'postsContent', 'postsIcon')"></i>
                        <div class="tab active" id="postsTab" onclick="toggleTab('postsTab', 'postsContent', 'postsIcon')">POSTS</div>
                    </div>
                    <div class="row post-grid">
                        @foreach ($user->posts->reverse() as $post)
                            <div class="col-md-4 mb-1">
                                <a href="/instagram/p/{{ $post->id }}">
                                    <div class="card post-card">
                                        @php
                                            $images = json_decode($post->images);
                                        @endphp
                                        @foreach ($images as $index => $image)
                                            @if ($index === 0)
                                                <div class='card-img card-img-top'>
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
        function toggleTab(tabId, contentId, iconId) {
            var tab = document.getElementById(tabId);
            var content = document.getElementById(contentId);
            var icon = document.getElementById(iconId);

            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            document.getElementById(contentId).classList.add('active');

            if (tabId === 'postsTab') {
                icon.className = 'bi bi-grid-3x2-gap-fill';
                document.getElementById('savedIcon').className = 'bi bi-bookmark';
            } else if (tabId === 'savedTab') {
                icon.className = 'bi bi-bookmark-fill';
                document.getElementById('postsIcon').className = 'bi bi-grid-3x2';
            }
        }

       //Post_View Script
       function redirectToTagView(tag) {
        var url = "{{ route('tags.view', ['tag_id' => ':tag_id']) }}";
        url = url.replace(':tag_id', tag);
        window.location.href = url;
        console.log('Hello Tag');
    }   

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.emoji').forEach(function(emojiItem) {
            emojiItem.addEventListener('click', function(event) {
                event.preventDefault();
                const emoji = this.getAttribute('data-emoji');
                const contentInput = document.getElementById('content');
                contentInput.value += emoji;
            });
        });
    });
   </script> 
        @yield ('post_scripts') 
          @yield ('following-script') 
@endsection
