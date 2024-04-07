<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    public function view(string $tag_name)
    {   
        $tag = \App\Models\Tag::where('name', $tag_name)->first();
        $postIds = $tag->posts()->pluck('post_id')->toArray();

        return view('tags.view', ['posts' => $postIds]);
    }
    
    // public function show(string $tag)
    // {
    //     $data = Tag::with('posts')->where('id',$tag)->first();
    //     return view('tag',['tag'=>$data]);
    // }

}

