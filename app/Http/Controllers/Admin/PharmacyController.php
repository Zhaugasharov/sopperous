<?php

namespace App\Http\Controllers\Admin;


use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use App\Models\Pharmacy;
use App\Models\Requirement;

class PharmacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['destroy']);
        View::share('menu', 'pharmacy');

       $users = User::orderBy('sname','asc')->get();
        View::share('users', $users);
    }

    public function index(Request $request)
    {
        $row = Pharmacy::leftJoin('users','users.id','=','pharmacy.user_id')
                    ->orderBy('pharmacy.created_at','desc')
                    ->select('*');

        if(isset($request->name) && $request->name != ''){
            $row->where(function($query) use ($request){
                $query->where('pharmacy_name','like','%' .$request->name .'%');
            });
        }

        if(isset($request->address) && $request->address != ''){
            $row->where(function($query) use ($request){
                $query->where('address','like','%' .$request->address .'%');
            });
        }

        if(isset($request->user_name) && $request->user_name != ''){
            $row->where(function($query) use ($request){
                $query->where('sname','like','%' .$request->user_name .'%')
                    ->orWhere('fname','like','%' .$request->user_name .'%');
            });
        }

        $row = $row->paginate(20);

        return  view('admin.pharmacy.pharmacy',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Pharmacy();
        
        return  view('admin.pharmacy.pharmacy-edit', [
            'title' => 'Добавить аптеку',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pharmacy_name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.pharmacy.pharmacy-edit', [
                'title' => 'Добавить аптеку',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $pharmacy = new Pharmacy();
        $pharmacy->pharmacy_name  = $request->pharmacy_name;
        $pharmacy->address  = $request->address;
        $pharmacy->user_id  = $request->user_id;
        $pharmacy->save();

        return redirect('/admin/pharmacy');
    }

    public function edit($id)
    {
        $row = Pharmacy::where('pharmacy_id',$id)->select('*')->first();

        return  view('admin.pharmacy.pharmacy-edit', [
            'title' => 'Редактировать аптеку',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'pharmacy_name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.pharmacy.pharmacy-edit', [
                'title' => 'Редактировать аптеку',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $pharmacy = Pharmacy::find($id);
        $pharmacy->pharmacy_name  = $request->pharmacy_name;
        $pharmacy->address  = $request->address;
        $pharmacy->user_id  = $request->user_id;
        $pharmacy->save();

        return redirect('/admin/pharmacy');
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::find($id);
        $pharmacy->delete();
    }
}
