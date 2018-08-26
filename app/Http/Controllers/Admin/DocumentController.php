<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use App\Models\Document;
use App\Models\Requirement;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'document');

       $requirement = Requirement::where('is_show',1)->orderBy('sort_num','asc')->get();
        View::share('requirement', $requirement);
    }

    public function index(Request $request)
    {
        $row = Document::leftJoin('requirement','requirement.requirement_id','=','document.requirement_id')
                    ->orderBy('document.sort_num','asc')
                    ->select('*','document.sort_num as sort_num');

        if(isset($request->active))
            $row->where('document.is_show',$request->active);
        else $row->where('document.is_show','1');

        if(isset($request->name) && $request->name != ''){
            $row->where(function($query) use ($request){
                $query->where('document_name_ru','like','%' .$request->name .'%');
            });
        }

        if(isset($request->requirement_name) && $request->requirement_name != ''){
            $row->where(function($query) use ($request){
                $query->where('requirement_name_ru','like','%' .$request->requirement_name .'%');
            });
        }

        $row = $row->paginate(20);

        return  view('admin.document.document',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Document();
        $row->document_image = '/media/default.png';

        return  view('admin.document.document-edit', [
            'title' => 'Добавить документ',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.document.document-edit', [
                'title' => 'Добавить документ',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $document = new Document();
        $document->document_name_ru  = $request->document_name_ru;
        $document->document_text_ru  = $request->document_text_ru;
        $document->requirement_id  = $request->requirement_id;
        $document->sort_num = $request->sort_num?$request->sort_num:100;
        $document->is_show  = 1;

        if($request->parent_id != '') $document->parent_id = $request->parent_id;


        $document->save();

         $image_delete = \App\Models\Image::where('document_id',$document->document_id)->delete();
         
         if(isset($request->image_list)){

            foreach($request->image_list as $key => $item){
                $image = new \App\Models\Image();
                $image->image_url = $item;
                $image->image_type = $request['image_type'][$key];
                $image->document_id = $document->document_id;
                $image->save();
            }
        }

         if(isset($request->file_list)){
            $file_delete = \App\Models\File::where('document_id',$document->document_id)->delete();

            foreach($request->file_list as $key => $item){
                $file = new \App\Models\File();
                $file->file_url = $item;
                $file->file_name = $request->file_name[$key];
                $file->document_id = $document->document_id;
                $file->save();
            }
        }

        if(isset($request->website_list)){
            $website = \App\Models\DocumentWebsite::where('document_id',$document->document_id)->delete();

            foreach($request->website_list as $key => $item){
                $website = new \App\Models\DocumentWebsite();
                $website->website = $item;
                $website->website_name = $request->website_name[$key];
                $website->document_id = $document->document_id;
                $website->save();
            }
        }

        return redirect('/admin/document');
    }

    public function edit($id)
    {
        $row = Document::where('document_id',$id)->select('*')->first();
        $images = \App\Models\Image::where('document_id',$id)->orderBy('image_id','asc')->get();
        $files = \App\Models\File::where('document_id',$id)->orderBy('file_id','asc')->get();
        $document = \App\Models\DocumentWebsite::where('document_id',$id)->orderBy('document_website_id','asc')->get();

        return  view('admin.document.document-edit', [
            'title' => 'Редактировать документ',
            'row' => $row,
             'image' => $images,
             'file_list' => $files,
             'website_list' => $document,
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'document_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
             $images = \App\Models\Image::where('document_id',$id)->orderBy('image_id','asc')->get();
                    $files = \App\Models\File::where('document_id',$id)->orderBy('file_id','asc')->get();
                    $document = \App\Models\DocumentWebsite::where('document_id',$id)->orderBy('document_website_id','asc')->get();

            return  view('admin.document.document-edit', [
                'title' => 'Редактировать документ',
                'row' => (object) $request->all(),
                'error' => $error[0],
                'image' => $images,
                'file_list' => $files,
                'website_list' => $document,
            ]);
        }

        $document = Document::find($id);
        $document->document_name_ru  = $request->document_name_ru;
        $document->document_text_ru  = $request->document_text_ru;
        $document->requirement_id  = $request->requirement_id;
        $document->sort_num = $request->sort_num?$request->sort_num:100;
        $document->save();

           $image_delete = \App\Models\Image::where('document_id',$document->document_id)->delete();

        if(isset($request->image_list)){


            foreach($request->image_list as $key => $item){
                $image = new \App\Models\Image();
                $image->image_url = $item;
                $image->image_type = $request['image_type'][$key];
                $image->document_id = $document->document_id;
                $image->save();
            }
        }

         $file_delete = \App\Models\File::where('document_id',$document->document_id)->delete();

        if(isset($request->file_list)){


            foreach($request->file_list as $key => $item){
                $file = new \App\Models\File();
                $file->file_url = $item;
                $file->file_name = $request->file_name[$key];
                $file->document_id = $document->document_id;
                $file->save();
            }
        }

         $website = \App\Models\DocumentWebsite::where('document_id',$document->document_id)->delete();

         if(isset($request->website_list)){


            foreach($request->website_list as $key => $item){
                $website = new \App\Models\DocumentWebsite();
                $website->website = $item;
                $website->website_name = $request->website_name[$key];
                $website->document_id = $document->document_id;
                $website->save();
            }
        }

        return redirect('/admin/document');
    }

    public function destroy($id)
    {
        $document = Document::find($id);
        $document->delete();
    }

    public function changeIsShow(Request $request){
        $document = Document::find($request->id);
        $document->is_show = $request->is_show;
        $document->save();
    }

    public function getImageList(Request $request){
            $image[0]['image_url'] = $request->image_url;
            $image[0]['image_type'] = $request->image_type;

            return  view('admin.document.image-loop',[
                'image' => $image
            ]);
        }

     public function getFileList(Request $request){
                $image[0]['file_url'] = $request->file_url;
                $image[0]['file_name'] = $request->file_name;

                return  view('admin.document.file-loop',[
                    'file_list' => $image
                ]);
     }

      public function getWebsiteList(Request $request){
             $image[0]['website'] = $request->website;
             $image[0]['website_name'] = $request->website_name;

             return  view('admin.document.website-loop',[
                 'website_list' => $image
             ]);
      }
}
