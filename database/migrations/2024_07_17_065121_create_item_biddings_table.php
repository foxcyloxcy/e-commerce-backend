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
        Schema::create('item_biddings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('seller_id');
            $table->bigInteger('buyer_id');
            $table->decimal('asking_price', 12, 2);
            $table->text('remarks')->nullable();
            $table->smallInteger('is_accepted')->default(0); // 0 = NO, 1 = YES
            $table->smallInteger('status')->default(1); // 0 = Inactive, 1 = Active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_biddings');
    }
};
