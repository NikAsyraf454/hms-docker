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
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('fleet_id');
            $table->unsignedBigInteger('maintenance_type_id');
            $table->unsignedBigInteger('service_provider_id');
            $table->date('date');
            $table->integer('odometer_reading');
            $table->decimal('cost', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
             $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fleet_id')->references('id')->on('fleets');
            $table->foreign('maintenance_type_id')->references('id')->on('maintenance_types');
            $table->foreign('service_provider_id')->references('id')->on('service_providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
