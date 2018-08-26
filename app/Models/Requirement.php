<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Requirement extends Model
{
    protected $table = 'requirement';
    protected $primaryKey = 'requirement_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function getChildList($requirement_ids,$requirement_id){
        $requirement_list2 = \App\Models\Requirement::where('parent_id',$requirement_id)
                                                    ->orderBy('sort_num','asc')
                                                    ->get();

        foreach ($requirement_list2 as $item){
            $requirement_ids[] = $item->requirement_id;
            $requirement_db = new \App\Models\Requirement();
            $requirement_ids = $requirement_db->getChildList($requirement_ids,$item->requirement_id);
        }

        return $requirement_ids;
    }
    
}
