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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->bigInteger('user_id');
            $table->bigInteger('sub_category_id');
            $table->string('item_name');
            $table->string('item_description')->nullable();
            $table->decimal('price', 12, 2);
            $table->smallInteger('status')->default(0); // 0 = pending/for approval, 1 = published, 2 = rejected, 3 = purchased, 4 = accepted bid(show only on seller) , 5 = archive or deleted
            $table->text('reject_reason')->nullable();
            $table->smallInteger('is_bid')->default(0); // 0 = no, 1 = yes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
