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
            $table->unsignedBigInteger("staff_id");
            $table->unsignedBigInteger("fleet_id");
            $table->unsignedBigInteger("depo_id");
            $table->unsignedBigInteger("payment_id");
            $table->date('pickup_date');
            $table->date('return_date');
            $table->time('pickup_time');
            $table->time('return_time');
            $table->string('pickup_location');
            $table->string('return_location');
            $table->string('destination');
            $table->string('note')->nullable();
            $table->foreign('payment_id')->nullable()->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('depo_id')->nullable()->references('id')->on('deposits')->onDelete('cascade');
            $table->foreign('fleet_id')->nullable()->references('id')->on('fleets');
            $table->foreign('staff_id')->nullable()->references('id')->on('users');
            $table->foreign('customer_id')->nullable()->references('id')->on('customers');
            $table->timestamps();
        });
    }

    // public function up()
    // {
    //     Schema::table('rentals', function (Blueprint $table) {
    //         $table->date('pickup_date')->change();
    //         $table->time('pickup_time')->change();
    //         $table->date('return_date')->change();
    //         $table->time('return_time')->change();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
