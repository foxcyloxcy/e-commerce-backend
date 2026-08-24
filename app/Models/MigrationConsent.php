<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MigrationConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preference',
        'terms_accepted',
        'profile_snapshot',
        'selected_items',
        'accepted_at',
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'profile_snapshot' => 'array',
        'selected_items' => 'array',
        'accepted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
