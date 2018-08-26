<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 30.04.2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Auth;

class IndexController extends Controller
{
    public function index(){
        $pharmacy_count = Pharmacy::where('user_id',Auth::user()->id)->count();
        
        return  view('cabinet.index.index',[
            'pharmacy_count' => $pharmacy_count
        ]);
    }
}