<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->enum('property_type', ['studio', 'house', 'terraced-house', 'semi-detached-house', 'detached-house'])->nullable();
            $table->string('house_parts')->nullable();
            $table->string('property_inside_design')->nullable();
            $table->enum('carpet_service', ['hoovered', 'machine', 'no_carpet'])->nullable();
            $table->string('carpet_house_location')->nullable();
            $table->string('rug_size')->nullable();
            $table->string('upholstery_items')->nullable();
            $table->string('carpet_rug_material')->nullable();
            $table->string('furniture_items')->nullable();
            $table->string('furniture_material')->nullable();
            $table->string('mattress_size')->nullable();
            $table->string('curtain_size')->nullable();
            $table->enum('highest_window_location', ['ground', 'first-floor', 'second-floor', 'third-floor'])->nullable();
            $table->integer('window_sides', 11)->nullable();
            $table->integer('window_qty')->nullable();
            $table->string('window_others')->nullable();
            $table->string('oven_type')->nullable();
            $table->string('kitchen_accessory')->nullable();
            $table->string('kitchen_items')->nullable();
            $table->enum('kitchen_appliances', ['outside', 'inside-and-outside'])->nullable();
            $table->enum('cleaning_schedule', ['once', 'weekly', 'fortnightly', 'monthly'])->nullable();
            $table->enum('pets', ['yes', 'no'])->nullable();
            $table->enum('iron', ['yes', 'no'])->nullable();
            $table->string('office_rooms')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
