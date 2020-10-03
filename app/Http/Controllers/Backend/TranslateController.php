<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LanguageNation;
use App\Models\Translate;
use App\Models\LanguageKey;
use App\Exports\TranslateExport;
use App\Imports\TranslateImport;
use Maatwebsite\Excel\Facades\Excel;

class TranslateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $lang = session()->get('locale');
        $lang = session()->get('locale');
//        dd($lang);
        if(isset($lang)){
            $data = LanguageKey::with(array('language_nation'=>function($q){
                $q->where('locale',session()->get('locale'));
            }))->get();
        }else{
            $data = LanguageKey::with(array('language_nation'=>function($q){
                $q->where('locale','vi');
            }))->get();
        }



        $count = LanguageKey::count();
        // dd($count);
    foreach ($data as $item){
        // dd($item->language_nation[0]->pivot->title);
        $name[] = $item->title;
        $id[] = $item->id;
        foreach ($item->language_nation as $key => $value){
            $va[] = $value->pivot['title'];
        }
    }
    if(isset($va)){
        for($i = 0; $i < $count; $i++){

            foreach($id as $i2){
                $i1[] = $i2;
            }
            foreach($name as $nam){
                $na[] = $nam;
            }
            foreach($va as  $key => $v){
                if($key =! $i){
                    $v1[] = $v;
                }else{
                    $v1[] = "";
                }
            }
            $arr[] = [
                'id' => $i1[$i],
                'title' => $na[$i],
                'language' => $v1[$i]
            ];
        }
    }else{
        $arr = LanguageKey::all();
    }
        return view('admin.translate.index',compact('arr'));
    }


    public function export()
    {
        $lang = session()->get('locale');
    if(!isset($lang)){
        $lang = 'vi';
    }
        return Excel::download(new TranslateExport, $lang.'.xlsx');
    }


    public function import()
    {
        $lang = session()->get('locale');

        $language = LanguageNation::where('locale',$lang)->get();

        foreach ($language as $la){
            $id_key = $la->id;
        }
//        dd($id_key);
        $data = Translate::where('language_nation_id',$id_key)->get();
        foreach($data as $item){
            $ids[] = $item->id;
        }
//        dd($ids);
        if(isset($ids)) {
            Translate::destroy($ids);
        }
        $import = Excel::import(new TranslateImport(), request()->file('file_language'));
//        dd($import);
        return redirect()->back()->with('success', 'Đăng tải thành công !!!');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('admin.translate.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count =count($request->language_key_id);
//        $idl = $request->session()->get('locale');
        $lang = $request->session()->get('locale');
        $language = LanguageNation::where('locale',$lang)->get();
        foreach ($language as $langkey){
            $idl = $langkey->id;
        }
//        dd($idl);
//        dd($idl);
        for ($i = 0; $i < $count; $i++){
            $language_nation_id[$i] = $idl;
        }
        $language_key_id = $request->language_key_id;
        $title = $request->title;
        for ($i = 0; $i < $count; $i++){
            foreach ($language_key_id as $key => $key_id){
                $n1[] = $key_id;
            }
            foreach ($language_nation_id as $key => $nation_id){
                $n2[] = $nation_id;
            }
            foreach ($title as $key => $tit){
                $n3[] = $tit;
            }
            $data[$i] = [
                'language_key_id' =>$n1[$i],
                'language_nation_id' => $n2[$i],
                'title' => $n3[$i]
            ];
        }
//        dd($data);\

        $data_id = Translate::where('language_nation_id',$idl)->get();
//        dd($data_id);
        foreach($data_id as $item){
            $ids[] = $item->id;
        }
//        dd($ids);
        if(isset($ids)) {
            Translate::destroy($ids);
        }

        Translate::insert($data);
        return redirect()->back()->with('success','Thành công!');
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
