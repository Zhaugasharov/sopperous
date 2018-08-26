<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class PharmacyDocument extends Model
{
    protected $table = 'pharmacy_document';
    protected $primaryKey = 'pharmacy_document_id';
}
