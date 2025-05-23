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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('matric')->unique()->nullable();
            $table->string('email');
            $table->string('race');
            $table->string('phone');
            $table->string('ic')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('college');
            $table->string('faculty');
            $table->string('bank');
            $table->string('acc_num');
            $table->string('acc_num_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
