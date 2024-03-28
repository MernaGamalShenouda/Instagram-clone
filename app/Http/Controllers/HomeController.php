<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Follower;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $followeeIds = Follower::where('follower_id', $user->id)->pluck('followee_id');

        $posts = Post::whereIn('user_id', $followeeIds)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('home.index', ['user' => $user, 'posts' => $posts]);
    }
}
