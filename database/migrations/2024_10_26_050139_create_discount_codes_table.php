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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->decimal('discount_percentage', 12, 2)->nullable();
            $table->bigInteger('limit')->nullable()->default(0);
            $table->bigInteger('used')->nullable()->default(0);
            $table->smallInteger('status')->default(0)->comment('0 = Inactive, 1 = Active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
