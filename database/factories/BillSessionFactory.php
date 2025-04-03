<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bill;
use App\Models\BillSession;

class BillSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillSession::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'bill_id' => Bill::factory(),
            'title' => fake()->sentence(4),
            'amount' => fake()->numberBetween(-10000, 10000),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
        ];
    }
}
