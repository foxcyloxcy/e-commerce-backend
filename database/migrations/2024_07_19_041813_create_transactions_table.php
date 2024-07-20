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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('transaction_number')->unique();
            $table->bigInteger('user_id');
            $table->bigInteger('seller_id');
            $table->integer('items_quantity')->default(1);
            $table->integer('service_fee_percentage')->default(0);
            $table->decimal('service_fee_amount', 12, 2);
            $table->decimal('subtotal_amount', 12, 2);
            $table->decimal('discount_amount_percentage', 12, 2)->nullable();
            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->decimal('total_amount', 12, 2);
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
