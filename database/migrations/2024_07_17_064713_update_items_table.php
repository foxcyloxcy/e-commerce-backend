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
        Schema::table('items', function (Blueprint $table) {
            $table->smallInteger('is_featured')->default(0)->after('is_bid'); // 0 = no, 1 = yes
            $table->smallInteger('is_priority')->default(0)->after('is_featured'); // 0 = no, 1 = yes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('is_featured');
            $table->dropColumn('is_priority');
        });
    }
};
