<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    protected $table = 'user_companies';
    protected $fillable = ['name','phone', 'logo', 'user_id', 'address', 'city_id'];
}
