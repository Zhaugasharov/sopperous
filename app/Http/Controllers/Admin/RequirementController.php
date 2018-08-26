<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use App\Models\Requirement;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'requirement');
    }

    public function index(Request $request)
    {
        $row = Requirement::orderBy('sort_num','asc')

                    ->select('*');

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');


        if(isset($request->parent_id)){
            $row->where('parent_id',$request->parent_id);
        }
        else {
            $row->where('parent_id',null);
        }

        if(isset($request->name) && $request->name != ''){
            $row->where(function($query) use ($request){
                $query->where('requirement_name_ru','like','%' .$request->name .'%');
            });
        }



        $row = $row->paginate(20);

        return  view('admin.requirement.requirement',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Requirement();
        $row->requirement_icon = '/media/icon.png';

        return  view('admin.requirement.requirement-edit', [
            'title' => 'Добавить требование',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requirement_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.requirement.requirement-edit', [
                'title' => 'Добавить требование',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $requirement = new Requirement();
        $requirement->requirement_name_ru  = $request->requirement_name_ru;
        $requirement->requirement_icon  = $request->requirement_icon?:'';
        $requirement->sort_num = $request->sort_num?$request->sort_num:100;
        $requirement->is_show  = 1;

        if($request->parent_id != '') $requirement->parent_id = $request->parent_id;


        $requirement->save();

        return redirect('/admin/requirement');
    }

    public function edit($id)
    {
        $row = Requirement::where('requirement_id',$id)->select('*')->first();

        return  view('admin.requirement.requirement-edit', [
            'title' => 'Редактировать требование',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'requirement_name_ru' => 'required',
            'requirement_icon' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.requirement.requirement-edit', [
                'title' => 'Редактировать требование',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $requirement = Requirement::find($id);
        $requirement->requirement_name_ru  = $request->requirement_name_ru;
        $requirement->requirement_icon  = $request->requirement_icon;
        $requirement->sort_num = $request->sort_num?$request->sort_num:100;
        $requirement->is_show  = 1;
        if($request->parent_id != '') $requirement->parent_id = $request->parent_id;
        $requirement->save();

        return redirect('/admin/requirement');
    }

    public function destroy($id)
    {
        $requirement = Requirement::find($id);
        $requirement->delete();
    }

    public function changeIsShow(Request $request){
        $requirement = Requirement::find($request->id);
        $requirement->is_show = $request->is_show;
        $requirement->save();
    }
	
	 public function reorder(Request $request)
    {
        if(isset($request->requirement_list)){
            foreach($request->requirement_list as $key => $item){
                $requirement = Requirement::where('requirement_id',$item)->first();
                $requirement->sort_num = $key;
                $requirement->save();
            }
        }
    }
}
