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

        Schema::create('bill_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained();
            $table->string('title');
            $table->unsignedBigInteger('amount');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_sessions');
    }
};
