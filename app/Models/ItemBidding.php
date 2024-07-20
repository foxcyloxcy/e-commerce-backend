<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemBidding extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $fillable = [
        'item_id',
        'seller_id',
        'buyer_id',
        'remarks',
        'asking_price',
        'status',
        'is_accepted'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // public function items(): HasMany
    // {
    //     return $this->hasMany(ItemProperty::class, 'item_id');
    // }

    // public function item(): BelongsTo
    // {
    //     return $this->belongsTo(Item::class, 'id');
    // }
}
