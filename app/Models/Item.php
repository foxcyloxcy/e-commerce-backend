<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     protected $fillable = [
        'user_id',
        'sub_category_id',
        'item_name',
        'item_description',
        'price',
        'status',
        'reject_reason',
        'is_bid'
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

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate();
        });
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function itemProperty(): HasMany
    {
        return $this->hasMany(ItemProperty::class, 'item_id');
    }

    public function itemBidding(): HasMany
    {
        return $this->hasMany(ItemBidding::class, 'item_id');
    }

    public function itemComment(): HasMany
    {
        return $this->hasMany(ItemComment::class, 'item_id');
    }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }

    //relationship with sub category (not yet)
}
