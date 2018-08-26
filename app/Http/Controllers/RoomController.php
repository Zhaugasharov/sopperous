<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 29.04.2018
 * Time: 15:17
 */

namespace App\Http\Controllers;


use App\Models\UserEnterprise;

class RoomController extends Controller
{

    public function index(){

        $data['enterprises'] = UserEnterprise::getEnterpriseCount();

        return view('company/index', $data);
    }

}