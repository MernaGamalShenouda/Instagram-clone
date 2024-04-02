<?php

namespace App\Http\Controllers;

use stdClass;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created comment in storage.
     */
    public function storeComment(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
            'post_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'updated_at' => 'nullable|date',
            'created_at' => 'nullable|date',
        ]);
        
        // Create a new comment instance
        $comment = new \App\Models\Comment();
        $comment->content = $validatedData['content'];
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = $validatedData['user_id'];
        $comment->updated_at = $validatedData['updated_at'];
        $comment->created_at = $validatedData['created_at'];
                
        $comment->save();

        return redirect()->route('posts.view',['post_id' => $comment->post_id]);
   }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified clicked resource.
     */
    public function view(string $id) {
        $post = \App\Models\Post::with('user')->find($id);
        $post->images = 'images/posts/sky.jpg'; 
        $comments = \App\Models\Comment::where('post_id', $id)->get();

        $user = User::find($post->user_id);
        $user->updateAvatar($user->id);
        
        return view('posts.view', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
