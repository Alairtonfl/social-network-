<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_count = \App\Models\User::count();
        $post = \App\Models\Post::count();
        return [
            'comment' => $this->faker->text(),
            'created_at' => now(),
            'id_user' => rand(1,$user_count),
            'id_post' => rand(1,$post)
        ];
    }
}
