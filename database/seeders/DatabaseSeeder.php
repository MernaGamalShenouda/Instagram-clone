<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory; // Import factory function
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Factory::factoryForModel(Tag::class)->count(10)->create();
        // Factory::factoryForModel(Post::class)->count(50)->create();
    
        // Post::all()->each(function ($post) {
        //     $tags = Tag::inRandomOrder()->limit(rand(1, 3))->get();
        //     $post->tags()->attach($tags);
        // });
        User::factory(1)->create(['email'=>'ahmed@ahmed.com', 'password'=> Hash::make('12345')]);
        Tag::factory(1)->has(Post::factory(5))->create();
    }
    
}
