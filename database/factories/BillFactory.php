<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use App\Models\Batch;
use App\Models\Bill;
use App\Models\Classroom;

class BillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'academic_year_id' => AcademicYear::factory(),
            'classroom_id' => Classroom::factory(),
            'batch_id' => Batch::factory(),
            'semester' => fake()->randomElement(["ganjil","genap"]),
        ];
    }
}
