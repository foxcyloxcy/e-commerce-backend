<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MigrationItem extends Model
{
    protected $fillable = [
        'migration_case_id', 'source_user_id', 'source_vendor_id', 'source_item_id', 'source_category_id', 'source_sub_category_id', 'source_status', 'eligible', 'eligibility_reason', 'selected', 'source_snapshot', 'source_updated_at', 'snapshot_at',
        'taggy_product_payload', 'taggy_images_payload', 'taggy_categories_payload', 'taggy_colors_payload', 'mapping_status', 'mapping_errors', 'prepared_at', 'exported_at', 'taggy_temp_product_id', 'taggy_product_id',
    ];

    protected $casts = [
        'eligible' => 'boolean',
        'selected' => 'boolean',
        'source_snapshot' => 'array',
        'taggy_product_payload' => 'array',
        'taggy_images_payload' => 'array',
        'taggy_categories_payload' => 'array',
        'taggy_colors_payload' => 'array',
        'mapping_errors' => 'array',
        'source_updated_at' => 'datetime',
        'prepared_at' => 'datetime',
        'exported_at' => 'datetime',
        'snapshot_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function migrationCase(): BelongsTo
    {
        return $this->belongsTo(MigrationCase::class, 'migration_case_id');
    }
}
