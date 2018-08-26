<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserEnterprise extends Model
{
    protected $table = 'user_enterprises';
    protected $fillable = ['name', 'city_id', 'address', 'phone', 'user_id', 'company_id'];

    public function rules(){
        return [

        ];
    }

    public static function getEnterpriseCount($userId = null){
        if(empty($userId))$userId = Auth::user()->id;
        return UserEnterprise::where(['user_id' => $userId])->count();
    }

    public static function getUserEnterprise($userId = null){
        if(empty($userId))$userId = Auth::user()->id;
        return UserEnterprise::where(['user_id' => $userId])->get();
    }

}
