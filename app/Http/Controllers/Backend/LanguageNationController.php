<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Files;
use Illuminate\Http\Request;
use App\Models\LanguageNation;

class LanguageNationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LanguageNation::orderBy('id','desc')->paginate(5);
        return view('admin.language.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create_edit');
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
            'title'=>'unique:language_nation,title',
            'locale'=>'unique:language_nation,locale'
        ],[
            'title.unique' => 'Ngôn ngữ quốc gia này đã tồn tại',
            'locale.unique' =>'Key đã tồn tại'
        ]);
        $input = $request->all();
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'language',null,100,100);
        }
//        dd($input);
        LanguageNation::create($input);
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
        $data = LanguageNation::find($id);
        return view('admin.language.create_edit',compact('data'));
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
        $data = LanguageNation::find($id);
        $input = $request->all();
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'language',null,100,100);
        }
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
        LanguageNation::destroy($id);
        return redirect()->route('language.index')->with('success','Xóa thành công !');
    }
}
