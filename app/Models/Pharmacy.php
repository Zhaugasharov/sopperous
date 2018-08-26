<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Pharmacy extends Model
{
    protected $table = 'pharmacy';
    protected $primaryKey = 'pharmacy_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
}
