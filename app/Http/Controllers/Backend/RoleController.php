<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::orderBy('id','desc')->paginate(5);
        return view('admin.roles.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::all();
        //return response()->json($permission);
        return view('admin.roles.create_edit')->with('permission',$permission);
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
            'title'=>'unique:permissions,title',
            'name'=>'unique:permissions,name'
        ],[
            'title.unique' => 'Tên quyền đã tồn tại',
            'name.unique' =>'Key đã tồn tại'
        ]);
        $input = $request->except('permission_id');
        $data = Role::create($input);
        $data->syncPermissions($request->permission_id);
        return redirect()->route('role.create')->with('success','Thêm thành công');
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
        $permission = Permission::all();
        $data = Role::findOrFail($id);
        $id_permisson = json_decode($data->permissions);
        return view('admin.roles.create_edit',['data'=>$data, 'permission'=>$permission,'id_permisson'=>$id_permisson]);
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
        $data = Role::find($id);
        $input = $request->except('permission_id');
        $data->update($input);
        $data->syncPermissions($request->permission_id);
        return redirect()->route('role.index')->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('role.index')->with('success','Xóa thành công');
    }
}
