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
        Schema::create('item_properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('sub_property_value_id');
            $table->smallInteger('status')->default(1); //1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_properties');
    }
};
