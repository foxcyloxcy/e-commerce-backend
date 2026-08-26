<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('migration_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('response_deadline')->nullable();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('migration_cases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('source_user_id');
            $table->unsignedBigInteger('source_vendor_id')->nullable();
            $table->string('status', 40)->default('PENDING')->index();
            $table->timestamp('started_at')->nullable()->index();
            $table->timestamp('last_activity_at')->nullable()->index();
            $table->timestamp('submitted_at')->nullable()->index();
            $table->timestamps();

            $table->unique(['campaign_id', 'source_user_id'], 'migration_cases_campaign_user_unique');
            $table->index(['status', 'submitted_at'], 'migration_cases_status_submitted_index');
        });

        Schema::create('migration_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('migration_case_id')->unique();
            $table->unsignedBigInteger('source_user_id')->index();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->text('address')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->json('source_snapshot')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamp('snapshot_at')->nullable();
            $table->timestamps();
        });

        Schema::create('migration_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('migration_case_id');
            $table->unsignedBigInteger('source_user_id')->index();
            $table->unsignedBigInteger('source_vendor_id')->nullable();
            $table->unsignedBigInteger('source_item_id');
            $table->unsignedBigInteger('source_category_id')->nullable()->index();
            $table->unsignedBigInteger('source_sub_category_id')->nullable()->index();
            $table->smallInteger('source_status')->nullable()->index();
            $table->boolean('eligible')->default(false)->index();
            $table->string('eligibility_reason')->nullable();
            $table->boolean('selected')->default(false)->index();
            $table->json('source_snapshot')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamp('snapshot_at')->nullable();
            $table->timestamps();

            $table->unique(['migration_case_id', 'source_item_id'], 'migration_items_case_item_unique');
            $table->index(['migration_case_id', 'selected', 'eligible'], 'migration_items_case_selected_eligible_index');
        });

        Schema::create('migration_consent_versions', function (Blueprint $table) {
            $table->id();
            $table->string('version', 40);
            $table->string('consent_type', 40)->index();
            $table->string('title');
            $table->longText('content');
            $table->string('content_hash', 64);
            $table->timestamp('effective_from')->nullable();
            $table->timestamp('effective_until')->nullable();
            $table->boolean('active')->default(true)->index();
            $table->timestamp('created_at')->nullable();

            $table->unique(['version', 'consent_type'], 'migration_consent_version_type_unique');
        });

        Schema::create('migration_decision_audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('migration_case_id')->index();
            $table->unsignedBigInteger('source_user_id')->index();
            $table->unsignedBigInteger('campaign_id')->index();
            $table->string('decision', 40)->index();
            $table->unsignedBigInteger('consent_version_id')->nullable();
            $table->string('consent_version')->nullable();
            $table->string('consent_content_hash', 64)->nullable();
            $table->unsignedInteger('selected_item_count')->default(0);
            $table->json('selected_source_item_ids')->nullable();
            $table->timestamp('campaign_deadline')->nullable();
            $table->timestamp('submitted_at')->index();
            $table->timestamp('created_at')->nullable();
        });

        $now = now();
        $versions = [
            ['ACCOUNT_AND_ITEMS', 'Account and selected listings migration consent', 'I agree to migrate my reviewed Reloved profile details and selected eligible listings to Taggy. I understand that only eligible selected listings will be prepared for transfer, Taggy is a separate live marketplace, and additional Taggy setup or verification may still be required.'],
            ['ACCOUNT_ONLY', 'Account-only migration consent', 'I agree to migrate my reviewed Reloved profile details to Taggy, but not my Reloved listings. I understand my listings will be excluded from the Taggy migration.'],
            ['DECLINE_KEEP', 'Decline Taggy migration confirmation', 'I do not want to migrate my Reloved profile or listings to Taggy. I understand nothing will be transferred to Taggy and my existing Reloved data will remain handled under the applicable Reloved privacy and data-retention policy.'],
            ['DELETE_REQUEST', 'Reloved deletion request confirmation', 'I do not want to migrate to Taggy and I want to request deletion of my Reloved data. I understand nothing will be transferred to Taggy, deletion will be handled subject to lawful retention obligations, and backup-retention periods may apply.'],
        ];

        foreach ($versions as [$type, $title, $content]) {
            DB::table('migration_consent_versions')->insert([
                'version' => 'uat-v1',
                'consent_type' => $type,
                'title' => $title,
                'content' => $content,
                'content_hash' => hash('sha256', $content),
                'effective_from' => $now,
                'active' => true,
                'created_at' => $now,
            ]);
        }

        DB::table('migration_campaigns')->insert([
            'name' => 'Reloved to Taggy UAT',
            'response_deadline' => env('TAGGY_MIGRATION_RESPONSE_DEADLINE'),
            'active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('migration_decision_audits');
        Schema::dropIfExists('migration_consent_versions');
        Schema::dropIfExists('migration_items');
        Schema::dropIfExists('migration_profiles');
        Schema::dropIfExists('migration_cases');
        Schema::dropIfExists('migration_campaigns');
    }
};
