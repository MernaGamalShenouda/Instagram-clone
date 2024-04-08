<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::withCount('posts')->paginate();
        return view('users.index', compact('users'));
    }

    public function show(string $id) {
        $user = \App\Models\User::with(['following', 'followers'])->find($id);
        return view('users.show', ['user' => $user]);
    }


    public function destroy(string $id) {
        $user = \App\Models\User::findOrFail($id);
        
        $user->posts()->delete();
        $user->likes()->delete();
        $user->followers()->detach();
        $user->following()->detach();
        
        $user->delete();
        
        $users = \App\Models\User::withCount('posts')->paginate();
        return view('users.index', compact('users'));
    }
}
