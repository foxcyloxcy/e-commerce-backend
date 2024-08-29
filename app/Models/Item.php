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
    
    // Statuses
    const STATUS_PENDING = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_SOLD = 3;
    const STATUS_BID_ACCEPTED = 4;
    const STATUS_ARCHIVED = 5;


    const STATUSES = [self::STATUS_PENDING => 'Pending', self::STATUS_PUBLISHED => 'Published', self::STATUS_REJECTED => 'Rejected', self::STATUS_SOLD => 'Sold', self::STATUS_BID_ACCEPTED => 'Bid Accepted', self::STATUS_ARCHIVED => 'Archived'];


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
        'is_bid',
        'address'
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
        'default_image',
        'status_name',
        'has_offer'
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

    /**
     * Attributes
     */

    // Get Default Photo
    public function getDefaultImageAttribute()
    {
        return $this->itemImage ? $this->itemImage->first() : null;
    }

    // Get Status Name
    public function getStatusNameAttribute(): string
    {
        return (isset(self::STATUSES[$this->status])) ? self::STATUSES[$this->status] : '';
    }

     // Get If Has Offer in  Bidding
     public function getHasOfferAttribute(): string|null
     {
        if(auth('auth-api')->check()){
            $hasOffer = $this->ItemBidding->where('buyer_id', auth('auth-api')->user()->id)->whereIn('is_accepted', [0,2])->first();
            if(!empty($hasOffer)){
                return 'Yes';
            }else{
                return 'No';
            }
        }else{
            return 'No';
        }
     }

    /**
     * Relationships
     */
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

    public function itemImage(): HasMany
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

}
