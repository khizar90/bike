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
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no');
            $table->string('type');
            $table->string('email');
            $table->string('date');
            $table->string('person_name')->default('');
            $table->string('bike_name');
            $table->string('bike_model');
            $table->string('engine_number');
            $table->string('chassis_number');
            $table->string('registration');
            $table->string('registration_name')->default('');
            $table->string('registration_number')->default('');
            $table->string('claim_book');
            $table->string('key_number')->default('');
            $table->string('agency_name')->default('');
            $table->string('image')->default('');
            $table->string('customer_name');
            $table->string('customer_phone')->default('');
            $table->string('customer_address')->default('');
            $table->string('customer_id_card')->default('');
            $table->string('customer_id_front')->default('');
            $table->string('customer_id_back')->default('');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
