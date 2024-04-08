@extends('layouts.main')

@section('profile_content')
<!-- User info -->
    <div class="container">
        <div class="profile-header">
            <img src="{{ $user->avatar }}" alt="Avatar" class="profile-avatar">
            <div class="profile-details">
                <div class="d-flex align-items-center">
                    <h5>{{ $user->username }}</h5>
                    @if (auth()->check())
                        @if (auth()->user()->id === $user->id)
                            <a href="{{ route('profile.edit') }}" class="edit-button ml-3 edit-button">Edit profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="mt-3 log-out-button">Log Out</button>
                            </form>
                        @else
                            @if (auth()->user()->following->contains($user))
                                <form action="{{ route('profile.unfollow', $user->username) }}" method="POST">
                                    @csrf
                                    <button class="follow-button ml-3">Unfollow</button>
                                </form>
                            @else
                                @if ($isFollowingBack)
                                    <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                                        @csrf
                                        <button class="follow-button ml-3">Follow back</button>
                                    </form>
                                @else
                                    <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                                        @csrf
                                        <button class="follow-button ml-3">Follow</button>
                                    </form>
                                @endif
                            @endif
                        @endif
                    @else
                        <form action="{{ route('profile.follow', $user->username) }}" method="POST">
                            @csrf
                            <button class="follow-button ml-3">Follow</button>
                        </form>
                    @endif
                </div>
                <div class="profile-stats">
                    <div><strong>{{ $user->posts()->count() }}</strong> posts</div>
                    <div><strong>{{ $user->followers()->count() }}</strong> <a href="#" data-toggle="modal" data-target="#followersModal">followers</a></div>
                    <div><strong>{{ $user->following()->count() }}</strong> <a href="#" data-toggle="modal" data-target="#followingModal">following</a></div>
                </div>
                <div class="profile-bio">
                    <h6>{{ $user->full_name }}</h6>
                    <p>{{ $user->bio }}</p>
                    <p><a href="{{ $user->website }}">{{ $user->website }}</a></p>
                </div>
            </div>
        </div>
    </div>   
</div>

        <!-- followers modal -->
        <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content modal-content-profile">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followersModalLabel">Followers</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- following modal -->
        <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content modal-content-profile">
                    <div class="modal-header">
                        <h5 class="modal-title" id="followingModalLabel">Following</h5>  
                    </div>
                </div>
            </div>
        </div>
@endsection



@section('following-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>

    $(document).ready(function() {
        function loadFollowersModal() {
            $.get('{{ route("profile.followers", $user->username) }}', function(data) {
                $('#followersModal .modal-content-profile').html(data);
                $('#followersModal').modal('show');
            });
        }

        function loadFollowingModal() {
            $.get('{{ route("profile.following", $user->username) }}', function(data) {
                $('#followingModal .modal-content-profile').html(data);
                $('#followingModal').modal('show');
            });
        }

        $('[data-target="#followersModal"]').on('click', loadFollowersModal);
        $('[data-target="#followingModal"]').on('click', loadFollowingModal);
    });
</script>
@endsection