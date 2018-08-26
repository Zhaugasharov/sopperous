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
use App\Models\Requirement;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'users');
    }

    public function index(Request $request)
    {
        $row = User::leftJoin('user_companies','user_companies.id','=','users.company_id')
                    ->leftJoin('cities','cities.id','=','user_companies.city_id')
                    ->orderBy('users.created_at','desc')->select('*');

        if(isset($request->active))
            $row->where('confirm',$request->active);
        else $row->where('confirm','1');

        if(isset($request->user_name) && $request->user_name != ''){
            $row->where(function($query) use ($request){
                $query->where('sname','like','%' .$request->user_name .'%')
                    ->orWhere('fname','like','%' .$request->user_name .'%')
                    ->orWhere('email','like','%' .$request->user_name .'%');
            });
        }

        if(isset($request->company) && $request->company != ''){
            $row->where(function($query) use ($request){
                $query->where('name','like','%' .$request->company .'%')
                    ->orWhere('city','like','%' .$request->company .'%')
                    ->orWhere('address','like','%' .$request->company .'%');
            });
        }

        $row->select('*',
                'users.id',
            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
            DB::raw('DATE_FORMAT(users.limit_date,"%d.%m.%Y %H:%i") as limit_date')
            );

        $row = $row->paginate(20);

        return  view('admin.users.users',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function changeIsShow(Request $request){
        $user = User::find($request->id);
        $user->confirm = $request->is_show;
        $user->save();
    }

    public function showUserLimitEdit(Request $request,$id){
        $user = User::where('id',$id)
                    ->select('*',
                            DB::raw('DATE_FORMAT(limit_date,"%d.%m.%Y %H:%i") as limit_date'))
                    ->first();

        if($user == null) abort(404);

        return  view('admin.users.limit-edit',[
            'row' => $user,
            'title' => "Редактировать дату подписки",
            'request' => $request
        ]);
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
    }

    public function editUserLimit(Request $request)
    {
        $users = User::where('id',$request->user_id)->first();
        $timestamp = strtotime($request->limit_date);
        $timestamp = date("Y-m-d H:i", $timestamp);
        $users->limit_date = $timestamp;
        $users->save();

        return redirect('/admin/users');
    }
}
