<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'password',
        'address',
        'status',
        'photo',
        'gender',
        'date_of_birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Append Attribute
     */
    protected $appends = [
        'is_vendor',
        'has_bank_details',
        'gender_text'
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

    // Check if vendor
    public function getIsVendorAttribute()
    {
        return $this->vendor ? 'Yes': 'No';
    }

    // Check if has bank details
    public function getHasBankDetailsAttribute()
    {
        return $this->vendorBank ? 'Yes': 'No';
    }

    /**
     * Relationships
     */
    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }


    public function vendorBank(): HasOne
    {
        return $this->HasOne(VendorBank::class);
    }

    public function getGenderTextAttribute(): string
    {
        return match ($this->gender) {
            1 => 'Male',
            2 => 'Female',
            0, null => 'N/A',
            default => 'Unknown',
        };
    }

}
