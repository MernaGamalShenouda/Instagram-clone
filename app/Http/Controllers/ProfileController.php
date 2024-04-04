<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Follower;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $isFollowingBack = false;

        if (auth()->check()) {
            $authenticatedUser = auth()->user();
            $isFollowingBack = $authenticatedUser->followers->contains($user);
        }

        // dd($isFollowingBack); 
        return view('profile.show', ['user' => $user, 'isFollowingBack' => $isFollowingBack]);
    }

    public function follow($username)
    {
        $userToFollow = User::where('username', $username)->firstOrFail();
    
        if (auth()->user()->id === $userToFollow->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }
    
        $isFollowing = Follower::where('follower_id', auth()->user()->id)
                            ->where('followee_id', $userToFollow->id)
                            ->exists();
    
        if ($isFollowing) {
            return redirect()->back()->with('error', 'You are already following ' . $userToFollow->username);
        }
    
        $userToFollowBack = $userToFollow->followers->contains(auth()->user());
    
        Follower::create([
            'follower_id' => auth()->user()->id,
            'followee_id' => $userToFollow->id,
        ]);
    
        if ($userToFollowBack) {
            return redirect()->back()->with('success', 'You are now following ' . $userToFollow->username . ' back');
        }
    
        return redirect()->back()->with('success', 'You are now following ' . $userToFollow->username);
    }


    public function unfollow($username)
    {
        $userToUnfollow = User::where('username', $username)->firstOrFail();

        if (auth()->user()->id === $userToUnfollow->id) {
            return redirect()->back()->with('error', 'You cannot unfollow yourself.');
        }

        $follower = Follower::where('follower_id', auth()->user()->id)
                            ->where('followee_id', $userToUnfollow->id)
                            ->first();

        if (!$follower) {
            return redirect()->back()->with('error', 'You are not following ' . $userToUnfollow->username);
        }

        $follower->delete();

        return redirect()->back()->with('success', 'You have unfollowed ' . $userToUnfollow->username);
    }

    //TO-DO: to be edited
    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followers()->paginate(10);
        return view('profiles.followers', compact('followers'));
    }



    public function following($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $following = $user->following()->paginate(10);
        return view('profiles.following', compact('following'));
    }

}
