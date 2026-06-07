<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->text(100),
            'is_spam' => false,
        ];
    }

    public function spam(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_spam' => null,
        ]);
    }

    public function withEmail(): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => fake()->email(),
        ]);
    }
}
