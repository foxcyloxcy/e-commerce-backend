<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MigrationCase extends Model
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_CONSENT_ACCOUNT_AND_ITEMS = 'CONSENT_ACCOUNT_AND_ITEMS';
    const STATUS_CONSENT_ACCOUNT_ONLY = 'CONSENT_ACCOUNT_ONLY';
    const STATUS_DECLINED_KEEP_RELOVED = 'DECLINED_KEEP_RELOVED';
    const STATUS_DELETE_REQUESTED = 'DELETE_REQUESTED';
    const STATUS_NO_RESPONSE = 'NO_RESPONSE';

    const FINAL_STATUSES = [
        self::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
        self::STATUS_CONSENT_ACCOUNT_ONLY,
        self::STATUS_DECLINED_KEEP_RELOVED,
        self::STATUS_DELETE_REQUESTED,
    ];

    protected $fillable = [
        'campaign_id', 'source_user_id', 'source_vendor_id', 'status', 'started_at', 'last_activity_at', 'submitted_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'submitted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(MigrationCampaign::class, 'campaign_id');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(MigrationProfile::class, 'migration_case_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(MigrationItem::class, 'migration_case_id');
    }

    public function audits(): HasMany
    {
        return $this->hasMany(MigrationDecisionAudit::class, 'migration_case_id');
    }

    public function getDerivedStatusAttribute(): string
    {
        if (!in_array($this->status, [self::STATUS_PENDING, self::STATUS_IN_PROGRESS], true)) {
            return $this->status;
        }

        if ($this->campaign && $this->campaign->response_deadline && $this->campaign->response_deadline->isPast() && !$this->submitted_at) {
            return self::STATUS_NO_RESPONSE;
        }

        return $this->status;
    }
}
