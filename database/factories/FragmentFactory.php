<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fragment>
 */
class FragmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $storyId = \App\Models\Story::first()->id;
        
        return [
            'text' => fake()->text(),
            'order' => 0,
            'story_id' => $storyId,
            'deleted_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
