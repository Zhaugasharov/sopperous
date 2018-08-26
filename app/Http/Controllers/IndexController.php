<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 21.04.2018
 * Time: 22:12
 */

namespace App\Http\Controllers;


class IndexController
{
    public function index(){
        return view('main/index');
    }
}