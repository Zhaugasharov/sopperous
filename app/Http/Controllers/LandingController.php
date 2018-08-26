<?php
namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Input;
use View;
use File;
use DateTime;
use App\Models\Sop;
use App\Models\Gpp;
use App\Models\Company;
use App\Models\Helper;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index.index',
            [
                'menu' => 'home'
            ]);
    }


    public function advantage()
    {
        return view('landing.index.advantage',
            [
                'menu' => 'advantage'
            ]);
    }

    public function product()
    {
        return view('landing.index.product',
            [
                'menu' => 'product'
            ]);
    }

    public function video()
    {
        return view('landing.index.video',
            [
                'menu' => 'video'
            ]);
    }

    public function contact()
    {
        return view('landing.index.contact',
            [
                'menu' => 'contact'
            ]);
    }
}