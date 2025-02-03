<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemImage extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $fillable = [
        'item_id',
        'image_url',
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
     * Append Attribute
     */
    protected $appends = [
        'image_url',
    ];


    public function getImageUrlAttribute()
    {
        return str_replace(
            'https://reloved-prod.s3.eu-west-1.amazonaws.com/',
            'https://d8jhzix2pgo8p.cloudfront.net/',
            $this->attributes['image_url']
        );
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id');
    }
}
