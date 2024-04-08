<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="followersModalLabel">Followers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @foreach($followers as $follower)
                <div class="media">
                    <img src="{{ $follower->avatar }}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $follower->username }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>