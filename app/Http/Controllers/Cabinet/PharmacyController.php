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
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function showPharmacyList(){
        $pharmacy_list = Pharmacy::where('user_id',Auth::user()->id)->get();
        return  view('cabinet.pharmacy.list',[
            'pharmacy_list' => $pharmacy_list
        ]);
    }

    public function showPharmacyAdd($id = null){
        $city = City::get();
        if($id > 0){
            $row = Pharmacy::where('user_id',Auth::user()->id)->where('pharmacy_id',$id)->first();
            if($row == null) abort(404);
        }
        else {
            $row = new Pharmacy();
        }

        return  view('cabinet.pharmacy.add',[
            'city' => $city,
            'row' => $row
        ]);
    }

    public function savePharmacy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pharmacy_name' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('cabinet.pharmacy.add', [
                'row' => (object) $request->all(),
                'error' => $error[0],
                'city' => City::get()
            ]);
        }

        if($request->pharmacy_id > 0)
             $pharmacy = Pharmacy::find($request->pharmacy_id);
        else $pharmacy = new Pharmacy();

        $pharmacy->pharmacy_name  = $request->pharmacy_name;
        $pharmacy->address  = $request->address;
        $pharmacy->city_id  = $request->city_id;
        $pharmacy->user_id  = Auth::user()->id;
        $pharmacy->save();

        return redirect('/cabinet/pharmacy');
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::find($id);
        $pharmacy->delete();
    }
}