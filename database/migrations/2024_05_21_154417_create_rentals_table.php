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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id");
            $table->string("staff_id");
            $table->date('pickup_date');
            $table->date('return_date');
            $table->time('pickup_time');
            $table->time('return_time');
            $table->string('pickup_location');
            $table->string('return_location');
            $table->string('addon');
            $table->string('payment_status');
            $table->string('rental_amount');
            $table->string('addon_amount');
            $table->string('total_amount');
            $table->string('staff');
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
