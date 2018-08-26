<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 12.05.2018
 * Time: 17:09
 */

namespace App\Http\Controllers;


use App\Models\SopThumb;

class AjaxController extends Controller
{
    public function getSopThumbs($sopId, $size){
        $sops = SopThumb::getThumbs($sopId, $size);
        return json_encode($sops);
    }
}