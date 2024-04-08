<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\SavedPost;
use App\Models\Follower;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $user=User::find(2);

        $followeeIds = Follower::where('follower_id', $user->id)->pluck('followee_id');

        $posts = Post::whereIn('user_id', $followeeIds)
                    ->with('user', 'comments.user')
                    ->withCount('likes', 'comments')
                    ->orderBy('created_at', 'desc')
                    ->get();


        $followedIds = Follower::where('follower_id', $user->id)->pluck('followee_id')->toArray();
        $suggestions = User::whereNotIn('id', array_merge($followedIds, [$user->id]))->get();




        return view('home.index', ['user' => $user, 'posts' => $posts, 'suggestions' => $suggestions]);
    }

    public function createComment(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $request->input('post_id'),
            'user_id' => $request->input('user_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('home.index');
    }

    public function createLike(Request $request){
        $this->validate($request, [
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        $existingLike = Like::where('post_id', $request->input('post_id'))
                             ->where('user_id', $request->input('user_id'))
                             ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'post_id' => $request->input('post_id'),
                'user_id' => $request->input('user_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('home.index');
    }

    public function createBookmark(Request $request){
        $this->validate($request, [
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        $existingBookmark = SavedPost::where('post_id', $request->input('post_id'))
                             ->where('user_id', $request->input('user_id'))
                             ->first();

        if ($existingBookmark) {
            $existingBookmark->delete();
        } else {
            SavedPost::create([
                'post_id' => $request->input('post_id'),
                'user_id' => $request->input('user_id'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('home.index');

    }
    public function showSuggestions(){
        $user = Auth::user();
        $followedIds = Follower::where('follower_id', $user->id)->pluck('followee_id')->toArray();
        $suggestions = User::whereNotIn('id', array_merge($followedIds, [$user->id]))->get();


        return view('home.suggestions', ['suggestions' => $suggestions]);
    }
    public function search(Request $request)
{
    $search = $request->input('search');
    $results = User::where('username', 'like', "%$search%")
    ->orWhere('full_name', 'like', "%$search%")
    ->get();

    return view('home.search', ['results' => $results]);
}



}
