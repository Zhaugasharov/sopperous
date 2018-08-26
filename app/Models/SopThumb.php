<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SopThumb extends Model
{
    protected $table = 'sop_thumbs';
    protected $fillable = ['filename', 'sop_id', 'user_id'];

    public static function saveThumbs($sopId, $request){
        try{
            $sopModel = Sop::findOrFail($sopId);
            $thumb = null;

            foreach($request->thumbs as $k => $thumb){
                $extension = $thumb->extension();
                $filename = Auth::user()->id."_thumb_".time().$k.".".$extension;
                $thumb->storeAs('thumbs', $filename);

                $thumb = SopThumb::create([
                    'filename' => $filename,
                    'sop_id' => $sopModel->id,
                    'user_id' => Auth::user()->id
                ]);

                Helper::resizeImage(storage_path("app/thumbs/"), $filename, 70);
                Helper::resizeImage(storage_path("app/thumbs/"), $filename, 150);
            }

            if(empty($sopModel->thumb_id) && !empty($thumb->id)){
                $sopModel->thumb_id = $thumb->id;
                $sopModel->save();
            }
            return ['status' => 'success'];
        }catch (\Exception $e){
            return ['status' => 'error'];
        }
    }

    public static function getThumbs($sopId, $size){
        $size = $size.'x'.$size.'_';
        return SopThumb::select(DB::raw('id, CONCAT("'.$size.'",filename) AS filename'))
                ->where('sop_id', $sopId)
                ->get();
    }

    public static function removeThumb($id, $sopId){
        $thumbModel = SopThumb::find($id);
        $sopModel = Sop::find($sopId);

        unlink(storage_path('app/thumbs/'.$thumbModel->filename));
        unlink(storage_path('app/thumbs/70x70_'.$thumbModel->filename));
        unlink(storage_path('app/thumbs/150x150_'.$thumbModel->filename));


        if($thumbModel->sop_id == $sopId){
            $mainThumb = SopThumb::where('sop_id', $sopId)->first();
            if(!empty($mainThumb->id)){
                $sopModel->thumb_id = $mainThumb->id;
                $sopModel->save();
            }else{
                $sopModel->thumb_id = null;
                $sopModel->save();
            }
        }

        $thumbModel->delete();
    }

    public static function setMainThumb($id, $sopId){
        $sopModel = Sop::find($sopId);
        $sopModel->thumb_id = $id;
        $sopModel->save();
    }

}
