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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id");
            $table->string("category");
            // $table->unsignedBigInteger('claim_type_id');
            $table->string("details");
            $table->string('plate_number')->nullable();
            $table->date('date');
            $table->string('amount')->nullable();
            $table->string('receipt')->nullable();

            //Additional Details
            $table->string('destination')->nullable(); //extra job
            $table->string('matric')->nullable(); //depo morning
            $table->unsignedBigInteger('rental_id')->nullable(); //depo morning & members rental
            $table->string('commission')->nullable(); //depo morning
            //Admin
            $table->string('status')->default('pending');
            $table->string('payment_date')->nullable();
            $table->foreign('staff_id')->nullable()->references('id')->on('users');
            // $table->foreign('claim_type_id')->references('id')->on('claim_types')->onDelete('cascade');
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
