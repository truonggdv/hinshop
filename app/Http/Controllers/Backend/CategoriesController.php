<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
//        print_r("<pre>");
//        print_r(json_decode($data));
//        die();
//        foreach ($data as $key => $value){
//            if($value[parent_id])
//        }
        return view('admin.category.index',compact('data'));
    }
    public function nav(){
        $data = Category::all();
        return view('admin.layouts.sidebar',compact('data'));
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
        $this->validate($request,[
            'name' => 'unique:categories,name',
        ],[
            'name.unique'=>'Danh mục đã tồn tại',

        ]);
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        Category::create($input);
        return redirect()->back()->with('success','Thêm thành công');
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
        $data = Category::find($id);
        return view('admin.category.create_edit',compact('data','category'));
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
        $data =Category::find($id);
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        $input['parent_id']= $request->parent_id;
        $data->update($input);
        return redirect()->back()->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!isset($_GET['confirm'])){
            $delete =Category::where('parent_id', $id)->count();
        if ($delete){
            session()->flash('confirm_delete', $id);
            return redirect()->back();
        }
        }
        Category::where('id', $id)->orWhere('parent_id', $id)->delete();
//        News::where('parent_id',$id)->delete();

        return redirect()->route('categories.index')->with('success','Xóa thành công');
    }
}
