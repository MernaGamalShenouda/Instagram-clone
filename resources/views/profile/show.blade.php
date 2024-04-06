@extends('layouts.main')

@section('profile_content')
<!-- User info -->
<div class="container">
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

    </div> 
</div>  
@endsection


