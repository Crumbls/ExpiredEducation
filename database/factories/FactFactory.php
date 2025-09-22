<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fact>
 */
class FactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = $this->faker->optional(0.7)->dateTimeBetween('-2000 years', 'now');
        $endedAt = $startedAt ? $this->faker->optional(0.5)->dateTimeBetween($startedAt, 'now') : null;

        return [
            'title' => $this->faker->sentence(rand(3, 8)),
            'content_old' => $this->faker->paragraphs(rand(3, 10), true),
            'content_new' => $this->faker->paragraphs(rand(3, 10), true),
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
            'started_at_format' => $startedAt ? $this->faker->randomElement(['Y', 'Y-m', 'Y-m-d', 'c. Y', 'Y BCE']) : null,
            'ended_at_format' => $endedAt ? $this->faker->randomElement(['Y', 'Y-m', 'Y-m-d', 'c. Y', 'Y CE']) : null,
            'version' => 1,
            'parent_id' => null,
        ];
    }
}
