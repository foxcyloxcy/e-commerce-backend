<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MigrationDecisionAudit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'migration_case_id', 'source_user_id', 'campaign_id', 'decision', 'consent_version_id', 'consent_version', 'consent_content_hash', 'selected_item_count', 'selected_source_item_ids', 'campaign_deadline', 'submitted_at', 'created_at',
    ];

    protected $casts = [
        'selected_source_item_ids' => 'array',
        'campaign_deadline' => 'datetime',
        'submitted_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function migrationCase(): BelongsTo
    {
        return $this->belongsTo(MigrationCase::class, 'migration_case_id');
    }
}
