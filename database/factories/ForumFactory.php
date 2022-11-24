<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 *
	 * @throws \Exception
	 */
	public function definition(): array
	{
		$name = $this->faker->sentence();
		return [
			'name'     => $name,
			'uuid'     => Str::uuid(),
			'content'  => $this->faker->paragraph(2),
			'synopsis' => $this->faker->paragraph(1),
			'user_id'  => random_int(1, 50),
		];
	}
}
