<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use stdClass;
use Illuminate\Http\Request;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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
    // In your controller method
    // In your controller method
    public function create()
    {
        return view('posts.create');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->content = $validatedData['content'];
        $post->user_id = auth()->id();
        $post->published_at = Carbon::now();

        $imagePublicIds = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    // $imagePath = $image->store('images/posts', ['disk' => 'public']);
                    $result = Cloudinary::upload($image->getRealPath(), [
                        'folder' => 'Posts', 
                    ]);
                    $imagePublicIds[] = $result->getPublicId();
                }
            }
        }
        $post->images = json_encode($imagePublicIds);


        $post->save();

        return redirect()->route('posts.view', ['post_id' => $post->id]);
    }

   

    /**
     * Store a newly created comment in storage.
     */
    public function storeComment(Request $request)
    {
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

        return redirect()->route('posts.view', ['post_id' => $comment->post_id]);
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
    public function view(string $id)
    {
        $post = \App\Models\Post::with('user')->find($id);
        // $post->images = 'images/posts/sky.jpg';
        $comments = \App\Models\Comment::where('post_id', $id)->with('user')->get();


        $user = User::find($post->user_id);
        $user->updateAvatar($user->id);

        $userSigned = User::find(auth()->id());
        // dd($post->images);

        return view('posts.view', ['post' => $post, 'comments' => $comments, 'user' => $userSigned]);
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
