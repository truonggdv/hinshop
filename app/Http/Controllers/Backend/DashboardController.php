<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Carbon;
use App\Models\Pay;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;

        $pay1 = Pay::whereDay('created_at', '=', $day)
            ->get();
        $data1 = json_decode($pay1);
        $count1 = count($data1);
        if($count1 == 0){
            $sum1 = 0;
        }else{

            foreach ($data1 as $key => $a) {
                $b1[$key] = $a->total;
            }

            $sum1 = array_sum($b1);

        }



        $pay = Pay::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->get();
        $data = json_decode($pay);
        $count = count($data);
        if($count == 0){

            $sum = 0;

        }else{

            foreach ($data as $key => $a) {
                $b[$key] = $a->total;
            }

            $sum = array_sum($b);

        }
        $order = Pay::whereMonth('created_at', '=', $month)->where('status',0)->count();
        $order_r = Pay::whereMonth('created_at', '=', $month)->where('status',1)->count();


        $new = News::orderBy('id','desc')->first();
        $product = Product::orderBy('id','desc')->paginate(30);
        $news = News::orderBy('id','desc')->paginate(30);

        return view('admin.index',compact('new','product','news','sum','count','sum1','count1','order','month','order_r'));
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
}
