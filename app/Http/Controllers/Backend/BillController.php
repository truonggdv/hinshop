<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pay;

class BillController extends Controller
{
    public function index(){
        $data = Pay::where('status',0)->orderBy('id','desc')->get();
        $data_bill = Pay::where('status',1)->orderBy('id','desc')->get();
        return view('admin.bill.index',compact('data','data_bill'));
    }

    public function update(Request $request,$id){
        $data = Pay::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success','Đã xử lí đơn hàng');
    }
}
