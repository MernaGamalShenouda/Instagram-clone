<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    public function view(string $tag_name)
    {   
        $tag = \App\Models\Tag::where('name', $tag_name)->first();
        // $postIds = $tag->posts()->pluck('post_id')->toArray();
        $posts = $tag->posts()->get();

        return view('tag', ['posts' => $posts, 'tag' => $tag]);
    }
    
    // public function show(string $tag)
    // {
    //     $data = Tag::with('posts')->where('id',$tag)->first();
    //     return view('tag',['tag'=>$data]);
    // }

}

