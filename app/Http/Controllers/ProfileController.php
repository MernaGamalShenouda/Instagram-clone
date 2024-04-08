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
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::findOrFail($request->user()->id);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        $user->updateAvatar($user->id);

        $user->fill([
            'full_name' => $request->input('full_name'),
            'bio' => $request->input('bio'),
            'gender' => $request->input('gender'),
            'website' => $request->input('website'),
        ]);

        $user->save();
        if ($request->hasFile('image')) {

            $image=$request->file('image') ;
            
                if ($image->isValid()) {
                    $result = Cloudinary::upload($image->getRealPath(), [
                        'folder' => 'ProfileImgs',
                    ]);
                    $imagePublicId = $result->getPublicId();
                    $user->image = json_encode($imagePublicId);
                }
            
        }


        $user->save();

        if ($request->user()->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
        }


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
        return view('profile.show', ['user'=>$user]);
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

        Follower::create([
            'follower_id' => auth()->user()->id,
            'followee_id' => $userToFollow->id,
        ]);

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
