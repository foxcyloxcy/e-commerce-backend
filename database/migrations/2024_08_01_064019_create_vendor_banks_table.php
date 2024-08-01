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
        Schema::create('vendor_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('bank_id');
            $table->string('account_fullname')->nullable();
            $table->string('account_number')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_banks');
    }
};
