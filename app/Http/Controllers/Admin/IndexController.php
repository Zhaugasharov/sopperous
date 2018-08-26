<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 30.04.2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){

        return view('admin/index');
    }
}