<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'images' => json_encode([$this->faker->imageUrl()]),
            'published_at' => now(),
            'user_id' => 1
        ];
    }
}
