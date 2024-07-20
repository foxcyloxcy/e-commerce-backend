<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemProperty extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     protected $fillable = [
        'item_id',
        'sub_property_value_id',
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

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id');
    }

    // public function test(): HasMany
    // {
    //     return $this->HasMany(SubCategoryPropertyValue::class, 'id');
    // }
}
