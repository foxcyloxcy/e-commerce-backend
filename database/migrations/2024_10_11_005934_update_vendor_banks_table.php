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
        Schema::table('vendor_banks', function (Blueprint $table) {
            $table->dropColumn('bank_id');
            $table->string('account_id')->nullable()->after('user_id');
            $table->string('iban')->nullable()->after('account_id');
            $table->string('bic_code')->nullable()->after('iban');
            $table->string('bank_name')->nullable()->after('account_number');
            $table->text('bank_address')->nullable()->after('bank_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_banks', function (Blueprint $table) {
            $table->foreignId('bank_id')->after('user_id');
            $table->dropColumn('account_id');
            $table->dropColumn('iban');
            $table->dropColumn('bic_code');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_address');
        });
        
    }
};
