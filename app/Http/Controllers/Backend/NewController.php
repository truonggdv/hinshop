<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use App\Library\Files;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $time = Carbon::now();
//        dd($time);
        $category = Category::all();
        $data = News::orderBy('id','desc')->paginate(15);
        return view('admin.news.index',compact('data','category','time'));
    }
    public function Search(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = News::where('title', 'LIKE', "%{$query}%")->get();
//            dd($data);
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $item)
            {
                $output .= '
               <li><a href="/admin/new/'. $item->id .'">'.$item->title.'</a></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
//            return response()->json($data);
        }
    }

    public function getSearch(Request $request){
//        dd($request);
        $category = Category::all();
        $title = $request->search;
        $start = $request->time_start;
        $end = $request->time_end;
        $parent_id = $request->parent_id;
        $result = News::orderBy('id','desc');
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
        return view('admin.news.search',compact('data','title','count','parent_id','start','end','category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create_edit');
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
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'news',null,350,500);
        }
        if($request->file('image_extension')){
            $input['image_extension']=Files::upload_image($request->file('image_extension'),'news',null,450,600);
        }
        $input['slug'] = Str::slug($request->title.self::rand_string(10) . '_' . time());
        $input['author'] = Auth::user()->name;
        News::create($input);
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
        $data = News::find($id);
        return view('admin.news.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = News::find($id);
        return view('admin.news.create_edit',compact('data'));
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
        $data = News::find($id);
        $input = $request->except('changeTitle');
        $width = $request->width;
        $height = $request->height;
        $key = $request->changeTitle;
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'news',null,350,500);
        }
        if($request->file('image_extension')){
            $input['image_extension']=Files::upload_image($request->file('image_extension'),'news',null,450,600);
        }
        if($key == "on"){
            $input['slug'] = Str::slug($request->title.self::rand_string(10) . '_' . time());
        }

//        die();
        $input['author'] = Auth::user()->name;
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
        News::destroy($id);
        return redirect()->route('new.index')->with('success','Xóa thành công !');
    }
}
