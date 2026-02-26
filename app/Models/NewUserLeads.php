<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewUserLeads extends Model
{

    protected $table = 'user_emails';

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

}