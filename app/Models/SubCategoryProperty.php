<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategoryProperty extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

     protected $fillable = [
        'sub_category_id',
        'name',
        'status',
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

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'id');
    }

    public function subCategoryPropertyValue(): HasMany
    {
        return $this->hasMany(SubCategoryPropertyValue::class, 'sub_category_property_id');
    }
}
