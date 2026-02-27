<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewUserLeads extends Model
{

    protected $table = 'new_user_leads';

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

}