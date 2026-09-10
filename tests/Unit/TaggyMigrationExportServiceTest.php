<?php

namespace Tests\Unit;

use App\Models\MigrationCase;
use App\Models\MigrationDecisionAudit;
use App\Models\MigrationItem;
use App\Models\MigrationProfile;
use App\Services\TaggyMigrationExportService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class TaggyMigrationExportServiceTest extends TestCase
{
    public function test_it_exports_only_selected_eligible_items_and_keeps_unresolved_ids_blank(): void
    {
        $profile = new MigrationProfile;
        $profile->setRawAttributes([
            'first_name' => 'Test',
            'last_name' => 'Seller',
            'email' => 'seller@example.com',
            'mobile_number' => '+971500000000',
            'address' => 'Dubai',
            'taggy_user_payload' => json_encode(['first_name' => 'Test', 'email' => 'seller@example.com', 'gender' => 'Female']),
            'taggy_address_payload' => json_encode(['address' => 'Dubai']),
            'mapping_status' => 'incomplete',
            'mapping_errors' => json_encode([['field' => 'country_id']]),
        ]);
        $selected = new MigrationItem;
        $selected->setRawAttributes([
            'source_item_id' => 10,
            'source_category_id' => 1,
            'eligible' => true,
            'selected' => true,
            'taggy_product_payload' => json_encode(['product_name' => 'Dress', 'price' => 100]),
        ]);
        $unselected = new MigrationItem;
        $unselected->setRawAttributes([
            'source_item_id' => 11,
            'eligible' => true,
            'selected' => false,
        ]);
        $case = new MigrationCase;
        $case->setRawAttributes([
            'id' => 41,
            'campaign_id' => 1,
            'source_user_id' => 7,
            'status' => MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
        ]);
        $case->setRelation('profile', $profile);
        $case->setRelation('items', new Collection([$selected, $unselected]));
        $audit = new MigrationDecisionAudit;
        $audit->setRawAttributes([
            'decision' => MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
            'consent_version' => 'uat-v1',
            'consent_content_hash' => 'hash',
            'selected_item_count' => 1,
            'selected_source_item_ids' => json_encode([10]),
            'submitted_at' => Carbon::parse('2026-08-31 13:20:52', 'UTC'),
        ]);

        $exporter = new TaggyMigrationExportService;
        $rows = $exporter->rows($case, $audit);
        $row = array_combine($exporter->columns(), $rows[0]);

        self::assertCount(1, $rows);
        self::assertSame(10, $row['source_item_id']);
        self::assertSame('Dress', $row['temp_products.product_name']);
        self::assertNull($row['temp_products.default_category_id']);
        self::assertSame('female', $row['users.gender']);
        self::assertStringContainsString('country_id', $row['profile_mapping_errors']);
    }
}
