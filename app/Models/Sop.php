<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class Sop extends Model
{
    protected $table = 'sops';
    protected $fillable = ['document_code', 'document_name', 'example_empty', 'example_full', 'description', 'thumb_id', 'parent_id', 'position', 'has_children'];

    public static function getTemplateSop($parentId = null, $paginate = null){
        $sql  = "*";
        if(in_array(Auth::user()->role_id, [3,4])) $sql = "*, 1 AS hide";
        $sopModel = Sop::select(DB::raw($sql))
                    ->where('parent_id', '=',$parentId)
                    ->orderBy('position', 'asc');
        if(empty($paginate))
            return $sopModel->get();
        else
            return $sopModel->paginate($paginate);
    }

    public static function getSopExamples($type){
        return Sop::select('example_'.$type)
               ->whereNotNull('example_'.$type)
               ->pluck('example_'.$type);
    }

    public static function getTotalSop(){
        return Sop::count();
    }

    public static function createSop($data, $request){

        $sopModel = Sop::find($data['sopId']);

        if(!empty($sopModel->id)){
            $sopModel->has_children = 1;
            $sopModel->save();
        }

        if($request->hasFile('example_empty')){
            $extension = $request->example_empty->extension();
            $filename = Auth::user()->id.'_example_empty_'.time().'.'.$extension;
            $data['example_empty'] = $filename;
            $request->example_empty->storeAs('example', $filename);
        }else
            $data['example_empty'] = '';

        if($request->hasFile('example_full')){
            $extension = $request->example_full->extension();
            $filename = Auth::user()->id.'_example_full_'.time().'.'.$extension;
            $data['example_full'] = $filename;
            $request->example_full->storeAs('example', $filename);
        }else
            $data['example_full'] = '';

        $sopModel = Sop::create([
            'document_code' => $data['document_code'],
            'document_name' => $data['document_name'],
            'description' => $data['description'],
            'example_empty' => $data['example_empty'],
            'example_full' => $data['example_full'],
            'parent_id' => $data['sopId']
        ]);

        return $sopModel;
    }

    public static function updateSop($data, $request){
        $sopModel = Sop::find($data['sopId']);

        if($request->hasFile('example_empty')){

            if(Storage::exists('/example/'.$sopModel->example_empty) && !empty($sopModel->example_empty))
                Storage::delete('/example/'.$sopModel->example_empty);

            $extension = $request->example_empty->extension();
            $filename = Auth::user()->id.'_example_empty_'.time().'.'.$extension;
            $data['example_empty'] = $filename;
            $request->example_empty->storeAs('example', $filename);
        }else
            unset($data['example_empty']);

        if($request->hasFile('example_full')){

            if(Storage::exists('/example/'.$sopModel->example_full) && !empty($sopModel->example_full))
                Storage::delete('/example/'.$sopModel->example_full);

            $extension = $request->example_full->extension();
            $filename = Auth::user()->id.'_example_full_'.time().'.'.$extension;
            $data['example_full'] = $filename;
            $request->example_full->storeAs('example', $filename);
        }else
            unset($data['example_full']);

        $sopModel->update($data);

        return $sopModel;
    }

    public static function setThumbs($request){

    }

    public static function removeSop($sopId){
        $sopModel = Sop::find($sopId);
        if(!empty($sopModel->id)){
            if(!empty($sopModel->example_empty) && Storage::exists('/example/'.$sopModel->example_empty))
                Storage::delete('/example/'.$sopModel->example_empty);

            if(!empty($sopModel->example_full) && Storage::exists('/example/'.$sopModel->example_full))
                Storage::delete('/example/'.$sopModel->example_full);

            if($sopModel->has_children){
                $childs = Sop::where('parent_id', $sopModel->id)->get();
                foreach($childs as $child){
                    if(!empty($child->example_empty) && Storage::exists('/example/'.$child->example_empty))
                        Storage::delete('/example/'.$child->example_empty);

                    if(!empty($child->example_full) && Storage::exists('/example/'.$child->example_full))
                        Storage::delete('/example/'.$child->example_full);

                    if($child->has_children)
                        Self::removeSop($child->id);
                    else
                        $child->delete();
                }
            }
            $sopModel->delete();
        }
    }

}
