<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_session_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->unsignedBigInteger('total');
            $table->enum('status', ["paid","unpaid", "pending"])->default("unpaid");
            $table->dateTime('payment_date')->nullable();
            $table->string('proof')->nullable();
            $table->enum('payment_type', ["transfer","cash"]);
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_approved')->default(false);
            $table->string('date_approve')->nullable();
            $table->string('bank_id')->nullable()->nullable();
            $table->string('voucher_id')->nullable()->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
