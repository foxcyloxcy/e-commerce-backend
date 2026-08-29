<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('migration_profiles', function (Blueprint $table) {
            $table->json('taggy_user_payload')->nullable()->after('source_snapshot');
            $table->json('taggy_address_payload')->nullable()->after('taggy_user_payload');
            $table->json('taggy_bank_payload')->nullable()->after('taggy_address_payload');
            $table->string('mapping_status', 30)->nullable()->index()->after('taggy_bank_payload');
            $table->json('mapping_errors')->nullable()->after('mapping_status');
            $table->timestamp('prepared_at')->nullable()->index()->after('mapping_errors');
            $table->timestamp('exported_at')->nullable()->index()->after('prepared_at');
            $table->unsignedBigInteger('taggy_user_id')->nullable()->index()->after('exported_at');
        });

        Schema::table('migration_items', function (Blueprint $table) {
            $table->json('taggy_product_payload')->nullable()->after('source_snapshot');
            $table->json('taggy_images_payload')->nullable()->after('taggy_product_payload');
            $table->json('taggy_categories_payload')->nullable()->after('taggy_images_payload');
            $table->json('taggy_colors_payload')->nullable()->after('taggy_categories_payload');
            $table->string('mapping_status', 30)->nullable()->index()->after('taggy_colors_payload');
            $table->json('mapping_errors')->nullable()->after('mapping_status');
            $table->timestamp('prepared_at')->nullable()->index()->after('mapping_errors');
            $table->timestamp('exported_at')->nullable()->index()->after('prepared_at');
            $table->unsignedBigInteger('taggy_temp_product_id')->nullable()->index()->after('exported_at');
            $table->unsignedBigInteger('taggy_product_id')->nullable()->index()->after('taggy_temp_product_id');
        });
    }

    public function down(): void
    {
        Schema::table('migration_items', function (Blueprint $table) {
            $table->dropColumn([
                'taggy_product_payload', 'taggy_images_payload', 'taggy_categories_payload',
                'taggy_colors_payload', 'mapping_status', 'mapping_errors', 'prepared_at',
                'exported_at', 'taggy_temp_product_id', 'taggy_product_id',
            ]);
        });

        Schema::table('migration_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'taggy_user_payload', 'taggy_address_payload', 'taggy_bank_payload',
                'mapping_status', 'mapping_errors', 'prepared_at', 'exported_at', 'taggy_user_id',
            ]);
        });
    }
};
