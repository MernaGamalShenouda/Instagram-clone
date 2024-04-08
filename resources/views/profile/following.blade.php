<div class="modal-header">
    <h6 class="modal-title text-center" id="followingModalLabel">Following</h6>
</div>
<div class="modal-body">
    @foreach($following as $followee)
        <div class="media">
            <a href="{{ route('profile.show', $followee->username) }}">
                <img src="{{ $followee->avatar }}" class="mr-3 rounded-circle avatar-profile" alt="Avatar">
            </a>
            <div class="media-body d-flex align-items-center">
                <div>
                    <h6 class="mt-0 mb-1">
                        <a href="{{ route('profile.show', $followee->username) }}" class="user-name">{{ $followee->username }}</a>
                    </h6>
                    <p class="text-muted mb-0">
                        <a href="{{ route('profile.show', $followee->username) }}" class="full-name">{{ $followee->full_name }}</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>