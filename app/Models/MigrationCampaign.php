<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MigrationCampaign extends Model
{
    protected $fillable = ['name', 'response_deadline', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'response_deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function cases(): HasMany
    {
        return $this->hasMany(MigrationCase::class, 'campaign_id');
    }
}
