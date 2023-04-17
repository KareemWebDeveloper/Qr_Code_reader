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
        Schema::create('csv_data', function (Blueprint $table) {
            $table->id();
            $table->string('FIRSTNAME');
            $table->string('LASTNAME');
            $table->string('SSN')->unique();
            $table->float('TEST1')->nullable();
            $table->float('TEST2')->nullable();
            $table->float('TEST3')->nullable();
            $table->float('TEST4')->nullable();
            $table->float('TEST5')->nullable();
            $table->float('TEST6')->nullable();
            $table->float('TEST7')->nullable();
            $table->string('FINAL')->nullable();
            $table->string('GRADE');
            $table->foreignId("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_data');
    }
};
