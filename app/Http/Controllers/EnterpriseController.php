<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 29.04.2018
 * Time: 17:02
 */

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\UserEnterprise;

class EnterpriseController extends Controller
{

    public function index(){

        $data['enterprises'] = UserEnterprise::getUserEnterprise();

        return view('enterprise/list', $data);
    }

    public function formAdd(){
        $data['cities'] = City::getCityList();

        return view('enterprise/add', $data);
    }

}