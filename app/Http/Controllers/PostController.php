<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\SavedPost;
use App\Models\Post_Tag;
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
    public function create()
    {


        $userSigned = User::find(auth()->id());

        return view('posts.create', ['user' => $userSigned]);
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

        $tags = [];
        preg_match_all('/#(\w+)/', $validatedData['content'], $tags);

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

        foreach ($tags[1] as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tag->posts()->attach($post->id);
        }

        return redirect()->route('posts.view', ['post_id' => $post->id]);
    }

    public function suggestTags(Request $request)
    {
        $tag = $request->input('tag');

        $tags = Tag::where('name', 'like', $tag . '%')->limit(5)->get();

        return response()->json($tags);
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
        ]);

        Comment::create([
            'content' => $validatedData['content'],
            'post_id' => $validatedData['post_id'],
            'user_id' => $validatedData['user_id'],
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('posts.view', ['post_id' => $validatedData['post_id']]);
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

        return redirect()->route('posts.view', ['post_id' => $request->input('post_id')]);
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

        return redirect()->route('posts.view', ['post_id' => $request->input('post_id')]);
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
        $post = \App\Models\Post::with('user')
        ->withCount('likes', 'comments')
        ->find($id);       

        $comments = \App\Models\Comment::where('post_id', $id)->with('user')->get();

        $user = User::find($post->user_id);
        $user->updateAvatar($user->id);

        $userSigned = User::find(auth()->id());

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
