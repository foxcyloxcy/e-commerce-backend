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

     // is_accepted options
     const BID_STATUS_PENDING = 0;
     const BID_STATUS_ACCEPTED = 1;
     const BID_STATUS_REJECTED = 2;

     const BID_STATUSES = [self::BID_STATUS_PENDING => 'Pending', self::BID_STATUS_ACCEPTED => 'Accepted', self::BID_STATUS_REJECTED => 'Rejected'];

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

    /**
     * Append Attribute
     */
    protected $appends = [
        'bid_status_name',
    ];

    /**
     * Attributes
     */
    // Get Bid Status Name
    public function getBidStatusNameAttribute(): string
    {
        return (isset(self::BID_STATUSES[$this->is_accepted])) ? self::BID_STATUSES[$this->is_accepted] : '';
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

}
