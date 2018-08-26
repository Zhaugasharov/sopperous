<?php
/**
 * Created by PhpStorm.
 * User: Berik
 * Date: 30.04.2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Pharmacy;
use App\Models\PharmacyDocument;
use App\Models\PharmacyDocumentDelete;
use App\Models\Requirement;
use Auth;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function showRequirement($pharmacy_id = null){
        $pharmacy_list = Pharmacy::where('user_id',Auth::user()->id)->orderBy('pharmacy_id','asc')->get();

        if($pharmacy_id == null && count($pharmacy_list) > 0) {
            $pharmacy_id = $pharmacy_list[0]->pharmacy_id;
        }       
        else {
            $pharmacy = Pharmacy::where('user_id',Auth::user()->id)->where('pharmacy_id',$pharmacy_id)->orderBy('pharmacy_id','asc')->first();
            if($pharmacy == null) abort(404);
        }

        return  view('cabinet.requirement.list',[
            'pharmacy_id' => $pharmacy_id,
            'pharmacy_list' => $pharmacy_list
        ]);
    }


    public function getDocumentList(Request $request){
        $document_list = Document::where('requirement_id',$request->requirement_id)->orderBy('sort_num','asc')->get();

        return  view('cabinet.requirement.document-list-loop',[
            'document_list' => $document_list,
            'pharmacy_id' => $request->pharmacy_id,
            'requirement_id' => $request->requirement_id
        ]);
    }

    public function getRequirementList(Request $request){
        return  view('cabinet.requirement.requirement-list',[
            'requirement_id' => $request->requirement_id,
            'pharmacy_id' => $request->pharmacy_id
        ]);
    }

    /**
     * @param array $middleware
     */
    public function setDocumentPharmacy(Request $request)
    {
       if($request->is_checked == 1){
           $doc = PharmacyDocument::where('pharmacy_id',$request->pharmacy_id)->where('document_id',$request->document_id)->first();
           $delete = PharmacyDocumentDelete::where('pharmacy_id',$request->pharmacy_id)->where('document_id',$request->document_id)->first();
           if($doc == null && $delete == null){
               $doc = new PharmacyDocument();
               $doc->document_id = $request->document_id;
               $doc->pharmacy_id = $request->pharmacy_id;
               $doc->requirement_id = $request->requirement_id;
               $doc->user_id = Auth::user()->id;
               $doc->user_id = Auth::user()->id;
               $doc->save();
           }
       }
        else {
            $doc = PharmacyDocument::where('pharmacy_id',$request->pharmacy_id)->where('document_id',$request->document_id)->delete();
        }

        $result['status'] = true;
        $result['requirement_id'] = $request->requirement_id;
        return response()->json($result);
    }

    public function setDocumentPharmacyDelete(Request $request)
    {
        if($request->is_delete == 1){
            $doc = new PharmacyDocumentDelete();
            $doc->document_id = $request->document_id;
            $doc->pharmacy_id = $request->pharmacy_id;
            $doc->requirement_id = $request->requirement_id;
            $doc->user_id = Auth::user()->id;
            $doc->save();

            PharmacyDocument::where('pharmacy_id',$request->pharmacy_id)->where('document_id',$request->document_id)->delete();
        }
        else {
            PharmacyDocumentDelete::where('pharmacy_id',$request->pharmacy_id)->where('document_id',$request->document_id)->delete();
        }
        
        $result['status'] = true;
        return response()->json($result);
    }
}