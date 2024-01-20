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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('claim_code');
            $table->biginteger('user_id');
            $table->biginteger('shop_id');
            $table->double('weight');
            $table->boolean('with_pickup');
            $table->boolean('with_delivery');
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->double('total');
            $table->text('description');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
