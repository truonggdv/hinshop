<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LanguageNation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RequestLanguageController extends Controller
{
    public function index(Request $request,$id){
//        dd($id);
        if($id){
            Session::put('locale',$id);
        }
        return redirect()->back();
    }

}
