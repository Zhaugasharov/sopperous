<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SopFiles extends Model
{
    protected $table = 'sop_files';
    protected $fillable = ['filename', 'description', 'size', 'sop_id', 'user_id'];

    public static function uploadFiles(){

    }

}
