<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class PharmacyDocumentDelete extends Model
{
    protected $table = 'pharmacy_document_delete';
    protected $primaryKey = 'pharmacy_document_delete_id';
}
