<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    public function show(string $tag)
    {
        $data = Tag::with('posts')->where('id',$tag)->first();
        return view('tag',['tag'=>$data]);
    }

}

