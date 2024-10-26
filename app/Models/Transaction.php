<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Webpatser\Uuid\Uuid;

class Transaction extends Model
{
    use HasFactory;

    // guard name
    protected $guard_name = 'passport';

    // allow to edit all
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'transaction_number',
        'payment_ref',
        'payout_ref',
        'user_id',
        'seller_id',
        'items_quantity',
        'service_fee_percentage',
        'service_fee_amount',
        'subtotal_amount',
        'discount_amount_percentage',
        'discount_amount',
        'total_amount',
        'status'
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

    /**
     * Relationships
     */

    // public function transactionItem(): HasMany
    // {
    //     return $this->hasMany(TransactionItem::class, 'transaction_id');
    // }

    public function transactionItem(): HasOne
    {
        return $this->hasOne(TransactionItem::class, 'transaction_id');
    }

    // public function vendorBank(): BelongsTo
    // {
    //     return $this->belongsTo(VendorBank::class, 'vendor_bank_id');
    // }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }


}
