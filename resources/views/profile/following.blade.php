<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="followingModalLabel">Following</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @foreach($following as $followee)
                <div class="media">
                    <img src="{{ $followee->avatar }}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $followee->username }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>