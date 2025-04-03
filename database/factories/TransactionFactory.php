<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bank;
use App\Models\BillSession;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'bill_session_id' => BillSession::factory(),
            'student_id' => Student::factory(),
            'total' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->randomElement(["paid","unpaid"]),
            'payment_date' => fake()->dateTime(),
            'proof' => fake()->word(),
            'payment_type' => fake()->randomElement(["transfer","cash"]),
            'user_id' => User::factory(),
            'date_approve' => fake()->dateTime(),
            'bank_id' => Bank::factory(),
            'voucher_id' => Voucher::factory(),
        ];
    }
}
