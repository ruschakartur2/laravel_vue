<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseLanguage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(0, 10000),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static {
        return $this->afterCreating(function (Course $course) {
            // Create a CourseLanguage instance associated with the created Course
            $course->languages()->saveMany(CourseLanguage::factory()->times(3)->make());
        });
    }
}
