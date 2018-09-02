<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 06.05.2018
 * Time: 15:57
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Sop;
use App\Models\SopThumb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AjaxAdminController extends Controller
{
    public function getSop($id){
        return json_encode(Sop::getTemplateSop($id));
    }

    public function setSop(Request $request){
        $sop = $request->all();

        switch ($sop['action']){
            case "create":
                $sop = Sop::createSop($sop, $request);
            break;
            case "edit":
                $sop = Sop::updateSop($sop, $request);
            break;
        }

        return json_encode($sop);
    }

    public function setSopThumbs($id, Request $request){
        return SopThumb::saveThumbs($id, $request);
    }

    public function removeThumb($id, $sopId){
        SopThumb::removeThumb($id, $sopId);
        return json_encode(['status' => 'success']);
    }

    public function setMainThumb($id, $sopId){
        SopThumb::setMainThumb($id, $sopId);
        return json_encode(['status' => 'success']);
    }

    public function removeSop($sopId){
        Sop::removeSop($sopId);
    }

    public function sortSop(Request $request){
        $sops = $request->get('sops');
        foreach($sops as $k => $sop){
            $sopModel = Sop::find($sop);
            $sopModel->position = $k;
            $sopModel->save();
        }
        return json_encode(['status' => 'success']);
    }

    public function removeFile(Request $request){
        $data = $request->all();
        $sopModel = Sop::findOrFail($data['doc_id']);
        $type = ['doc_empty' => 'example_empty', 'doc_full' => 'example_full'];
        $type = $type[$data['type']];

        if(!empty($sopModel[$type]) && Storage::exists('/example/'.$sopModel[$type]))
            Storage::delete('/example/'.$sopModel[$type]);

        return json_encode(['status' => 'success']);
    }
}