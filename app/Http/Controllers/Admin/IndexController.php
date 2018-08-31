<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 30.04.2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\UserCompany;
use App\User;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(){
        $data['users'] = User::count();
        $data['usersConfirm'] = User::where('confirm', 1)->count();
        $data['pharmacy'] = Pharmacy::count();
        $data['company'] = UserCompany::count();
        $data['subscribes'] = User::whereNotNull('limit_date')->where('limit_date', '>', Carbon::now()->format("Y-m-d"))->count();
        return view('admin/index', $data);
    }
}