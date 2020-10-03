<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LanguageNation;
use App\Models\LanguageKey;
use App\Models\Translate;

class LanguageKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = session()->get('locale');
//        dd($lang);
        $data = LanguageKey::orderBy('id','desc')->get();
        return view('admin.key_language.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = LanguageNation::all();
        return view('admin.key_language.create_edit',compact('language'));
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
        LanguageKey::create($input);
        return redirect()->route('key.create')->with('success','Thêm thành công !');
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
        $data = LanguageKey::find($id);
        return view('admin.key_language.create_edit',compact('data'));
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
        $data = LanguageKey::find($id);
        $input = $request->all();
        $data->update($input);
        return redirect()->back()->with('success','Chỉnh sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $data = LanguageKey::find($id);
//        LanguageKey::destroy($id);
//        $data->language_nation()->detach($id);
//        return redirect()->route('key.index')->with('success','Xóa thành công !');

        $data = LanguageKey::find($id);
        $nation = Translate::where('language_key_id',$id)->get();
        foreach($nation as $item){
            $ids[] = $item->id;
        }
//        dd($ids);
        LanguageKey::destroy($id);
        Translate::destroy($ids);
        return redirect()->route('key.index')->with('success','Xóa thành công !');

    }
}
