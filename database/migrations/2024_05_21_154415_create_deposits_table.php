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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('date');
            $table->enum('status', ['Paid', 'Unpaid']);
            $table->string('fuel')->nullable();
            $table->string('late')->nullable();
            $table->string('extend')->nullable();
            $table->enum('extend_status', ['Paid', 'Unpaid'])->nullable();
            $table->string('proof')->nullable();
            $table->string('return_date')->nullable();
            $table->integer('return_amount')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
