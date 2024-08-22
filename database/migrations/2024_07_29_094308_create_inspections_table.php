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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_id');
            $table->unsignedBigInteger('staff_id');
            $table->string('type')->nullable();
            $table->string('parts')->nullable();
            $table->string('mileage')->nullable();
            $table->string('fuel')->nullable();
            $table->string('remarks')->nullable();
            $table->json('image')->nullable();
            // $table->string('img_front')->nullable();
            // $table->string('img_back')->nullable();
            // $table->string('img_left')->nullable();
            // $table->string('img_right')->nullable();
            // $table->string('img_add1')->nullable();
            // $table->string('img_add2')->nullable();
            $table->string('PIC')->nullable();
            $table->foreign('rental_id')->nullable()->references('id')->on('rentals');
            $table->foreign('staff_id')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
