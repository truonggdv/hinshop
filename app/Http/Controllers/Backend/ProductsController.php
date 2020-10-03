<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Files;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $data = Product::orderBy('id','desc')->get();
        return view('admin.product.index',compact('data','category'));
    }


    public function getSearch(Request $request){
//        dd($request);
        $category = Category::all();
        $title = $request->search;
        $start = $request->time_start;
        $end = $request->time_end;
        $parent_id = $request->parent_id;
        $result = Product::orderBy('id','desc');
        if(isset($title)){
            $search = str_replace(' ','%', $title);
            $result->where('title','like','%'.$search.'%');
        }
        if(isset($start)){
            $result->whereDate('updated_at','>=',$start);
        }
        if(isset($end)){
            $result->whereDate('updated_at','<=',$end);
        }
        if (isset($parent_id)){
            $result->where('parent_id',$parent_id);
        }
        $data = $result->paginate(15);
        $count = $result->count();
        return view('admin.product.search',compact('data','title','count','parent_id','start','end','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create_edit',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $sale = $request->sale;
        $price_old = $request->price_old;
        // dd($price_old);
        if($sale){
            $input['price'] = $price_old  - $price_old * ($sale / 100 );
        }else{
            $input['price'] = $price_old;
        }
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'products',null,270,360);
        }
        if($request->file('detailed_image_1')){
            $input['detailed_image_1']=Files::upload_image($request->file('detailed_image_1'),'products',null,270,360);
        }
        if($request->file('detailed_image_2')){
            $input['detailed_image_2']=Files::upload_image($request->file('detailed_image_2'),'products',null,270,360);
        }
        if($request->file('detailed_image_4')){
            $input['detailed_image_3']=Files::upload_image($request->file('detailed_image_3'),'products',null,270,360);
        }
        if($request->file('detailed_image_4')){
            $input['detailed_image_4']=Files::upload_image($request->file('detailed_image_4'),'products',null,270,360);
        }
        $input['slug'] = Str::slug($request->title.'-'.self::rand_string(10) . '_' . time());
        $input['author'] = Auth::user()->name;
    //    dd($input);
        Product::create($input);
        return redirect()->back()->with('success','Thêm mới thành công !');
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
        $category = Category::all();
        $data = Product::find($id);
        return view('admin.product.create_edit',compact('data','category'));
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
        $data = Product::find($id);
        $input = $request->except('changeSlug');
        $sale = $request->sale;
        $price_old = $request->price_old;
        $key = $request->changeSlug;

        if($sale){
            $input['price'] = $price_old  - $price_old * ($sale / 100 );
        }else{
            $input['price'] = $price_old;
        }
        if($key == "on"){
            $input['slug'] = Str::slug($request->title.'-'.self::rand_string(10) . '_' . time());
        }
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'products',null,270,360);
        }
        if($request->file('detailed_image_1')){
            $input['detailed_image_1']=Files::upload_image($request->file('detailed_image_1'),'products',null,270,360);
        }
        if($request->file('detailed_image_2')){
            $input['detailed_image_2']=Files::upload_image($request->file('detailed_image_2'),'products',null,270,360);
        }
        if($request->file('detailed_image_4')){
            $input['detailed_image_3']=Files::upload_image($request->file('detailed_image_3'),'products',null,270,360);
        }
        if($request->file('detailed_image_4')){
            $input['detailed_image_4']=Files::upload_image($request->file('detailed_image_4'),'products',null,270,360);
        }
        $input['author'] = Auth::user()->name;
        $data->update($input);
        // return redirect()->back()->with('success','Chỉnh sửa thành công');
        return redirect()->route('product.index')->with('success','Chỉnh sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('product.index')->with('success','Xóa thành công !');
    }
}
