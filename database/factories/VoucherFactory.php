<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Voucher;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => fake()->word(),
            'discount_type' => fake()->randomElement(["persen","fixed"]),
            'discount_value' => fake()->numberBetween(-10000, 10000),
            'valid_from' => fake()->dateTime(),
            'valid_until' => fake()->dateTime(),
        ];
    }
}
