<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sops'] = Sop::getTemplateSop(0);
        $data['total'] = Sop::getTotalSop();
        return view('sop/list', $data);
    }

    public function downloadAll($type){
        if(!in_array($type, ['empty', 'full'])) abort(404);
        $files = Sop::getSopExamples($type);
        $fileName = 'sops_'.$type.Auth::user()->id.'.zip';
        $zipper = new Zipper();
        $zipper->make(public_path($fileName));
        foreach($files as $file)
            if(file_exists(storage_path('app/example/'.$file)))
                $zipper->add(storage_path('app/example/'.$file));
        $zipper->close();
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    public function downloadSelected(Request $request){
        $data = $request->all();
        $fileName = 'sops_selected'.Auth::user()->id.'.zip';
        $zipper = new Zipper();
        $zipper->make(public_path($fileName));
        if(!empty($data['exp']) && count($data['exp'])>0){
            foreach($data['exp'] AS $k => $exp){
                if(!empty($data['exp_empty'][$k])){
                    if(file_exists(storage_path('app/example/'.$data['exp_empty'][$k])))
                        $zipper->add(storage_path('app/example/'.$data['exp_empty'][$k]));
                }
                if(!empty($data['exp_full'][$k])){
                    if(file_exists(storage_path('app/example/'.$data['exp_full'][$k])))
                        $zipper->add(storage_path('app/example/'.$data['exp_full'][$k]));
                }
            }
        }
        $zipper->close();
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Выгрузка примеров документов
    public function downloadExample($filename){
        $path = storage_path('app/example/'.$filename);
        return response()->download($path);
    }

    //Выгрузка картинок
    public function downloadThumb($filename){
        $path = storage_path('app/thumbs/'.$filename);
        return response()->download($path);
    }

}
