<?php

namespace App\Http\Controllers;

use stdClass;
use Illuminate\Http\Request;

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
        // $post = \App\Models\Post::find($id);

        // Create a dummy post object
        $post = new stdClass();
        $post->id = $id;
        $post->user_id = 1; 
        $post->body = "Dummy post body";
        $post->published_at = now(); 
        $post->likes = 0;
        $post->comments = 5;
        $post->image = 'images/posts/sky.jpg'; 

        return view('posts.view', ['post' => $post]);
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
