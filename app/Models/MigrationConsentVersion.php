<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigrationConsentVersion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'version', 'consent_type', 'title', 'content', 'content_hash', 'effective_from', 'effective_until', 'active', 'created_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'effective_from' => 'datetime',
        'effective_until' => 'datetime',
        'created_at' => 'datetime',
    ];
}
