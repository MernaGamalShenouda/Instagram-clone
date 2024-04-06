@extends('layouts.sidebar')

@section('title','Profile')

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
                    @foreach($user->posts as $post)
                        <div class="col-md-4 mb-1">
                            <a href="/instagram/p/{{ $post->id }}">
                                <div class="card post-card">
                                    <!-- <img class="card-img-top" src="{{ $post->images }}" alt="Post Image"> -->
                                    @php
                                        $images = json_decode(json_decode($post->images));
                                    @endphp
                                   @foreach ($images as $index => $image)
                                        @if ($index === 0)
                                            <div class='card-img'>
                                                <img src="https://res.cloudinary.com/dp3xwqpsq/image/upload/{{ $image }}" class="d-block img-fluid " alt="Post Image">
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

       //Post_View Script

       var comments = {!! json_encode($comments) !!};

        function getCurrentDateTime() {
            return new Date().toISOString();
        }

        function submitForm(event) {
            event.preventDefault(); 
            var formData = new FormData(event.target);
            
            formData.set('updated_at', getCurrentDateTime());
            formData.set('created_at', getCurrentDateTime());
            
            // Perform AJAX request
            fetch(event.target.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    var commentContent = event.target.querySelector('[name="content"]').value;
                    var newComment = { content: commentContent };

                    fetchComments(newComment);
                    event.target.querySelector('[name="content"]').value = ''; // Clear the input value
                } else {
                    console.error('Form submission failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function fetchComments(newComment) {
            var commentsContainer = document.getElementById('commentsContainer');
            var commentElement = document.createElement('p');
            var currentComments = parseInt($('.Comments').text());
            $('.Comments').text(currentComments+1);

            commentElement.innerHTML = `<strong>{{ $user->username }}:</strong> ${newComment.content}`;
            commentsContainer.appendChild(commentElement);
        }

        document.getElementById('commentForm').addEventListener('submit', submitForm);

        $(document).ready(function() {
            $('#like-form').submit(function(event) {
                // Prevent the form from submitting normally
                event.preventDefault();

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        var likeButton = $('#like-form').find('.like-button');
                        likeButton.toggleClass('liked');
                        likeButton.find('.fa-heart').toggleClass('fas black-heart').toggleClass('far');

                        var currentLikes = parseInt($('.Likes').text());
                        if (likeButton.hasClass('liked')) {
                            $('.Likes').text(currentLikes+1);
                        } else {
                            $('.Likes').text(currentLikes-1);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            // Bookmark form submission
            $('#bookmark-form').submit(function(event) {
                // Prevent the form from submitting normally
                event.preventDefault();

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        var bookmarkButton = $('#bookmark-form').find('.btn-lg');
                        bookmarkButton.find('.fa-bookmark').toggleClass('fas far');

                        // Optionally, you can update UI or perform other actions upon success
                        console.log('Bookmark action success');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function redirectToTagView(tag) {
            var url = "{{ route('tags.view', ['tag_id' => ':tag_id']) }}";
            url = url.replace(':tag_id', tag);
            window.location.href = url;
        }

   </script> 
@endsection
