<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MigrationProfile extends Model
{
    protected $fillable = [
        'migration_case_id', 'source_user_id', 'first_name', 'last_name', 'email', 'mobile_number', 'address', 'gender', 'date_of_birth', 'source_snapshot', 'source_updated_at', 'snapshot_at',
        'taggy_user_payload', 'taggy_address_payload', 'taggy_bank_payload', 'mapping_status', 'mapping_errors', 'prepared_at', 'exported_at', 'taggy_user_id',
    ];

    protected $casts = [
        'source_snapshot' => 'array',
        'taggy_user_payload' => 'array',
        'taggy_address_payload' => 'array',
        'taggy_bank_payload' => 'array',
        'mapping_errors' => 'array',
        'source_updated_at' => 'datetime',
        'prepared_at' => 'datetime',
        'exported_at' => 'datetime',
        'snapshot_at' => 'datetime',
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function migrationCase(): BelongsTo
    {
        return $this->belongsTo(MigrationCase::class, 'migration_case_id');
    }
}
