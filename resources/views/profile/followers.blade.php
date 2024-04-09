<div class="modal-header">
    <h6 class="modal-title text-center" id="followersModalLabel">Followers</h6>
</div>
<div class="modal-body">
    @foreach($followers as $follower)
            @php
            $image="https://res.cloudinary.com/dp3xwqpsq/image/upload/".json_decode($follower->image)
            @endphp
        <div class="media">
            <a href="{{ route('profile.show', $follower->username) }}">
                <img src="{{ $follower->image?$image:$follower->avatar }}" class="mr-3 rounded-circle avatar-profile" alt="Avatar">
            </a>
            <div class="media-body d-flex align-items-center">
                <div>
                    <h6 class="mt-0 mb-1">
                        <a href="{{ route('profile.show', $follower->username) }}" class="user-name">{{ $follower->username }}</a>
                    </h6>
                    <p class="text-muted mb-0">
                        <a href="{{ route('profile.show', $follower->username) }}" class="full-name">{{ $follower->full_name }}</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>