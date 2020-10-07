<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Files;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = User::orderBy('id','desc')->paginate(10);
        $data_admin = User::role('admin')->orderBy('id','desc')->get();
        $data_member = User::role('member')->orderBy('id','desc')->get();
        $data = User::orderBy('id','desc')->get();
        return view('admin.user.index',compact('data_member','data_admin','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('admin.user.create_edit',compact('role'));
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
            'email' => 'required|unique:users,email',
            're_password'=>'same:password',
        ],[
            'email.unique'=>'Email đã được sử dụng',
            're_password.same' => 'Mật khẩu nhập lại không đúng'

        ]);
        $input = $request->all();
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'profile',null,70,70);
        }
        $input['password'] = Hash::make($request->password);
//        dd($input);
        $userCreate = User::create($input);
        $roles = $request->roles;
        $userCreate->syncRoles($roles);
        return redirect()->back()->with('success','Thêm mới thành công');
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
        $data = User::findOrFail($id);
        $role = Role::all();
        $id_roles = json_decode($data->roles);

        return view('admin.user.create_edit',['data'=>$data,'role'=>$role,'id_roles'=>$id_roles]);
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
        $data = User::FindOrFail($id);
        $role = Role::all();

        $this->validate($request,[
            're_password'=>'same:password',
        ],[
            're_password.same' => 'Mật khẩu nhập lại không đúng'

        ]);
        $key = $request->changePassword;
        if($key == "on"){
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'profile',null,70,70);
        }
//        dd($input);
        $data->update($input);
        $roles = $request->roles;

        $data->syncRoles($roles);
        return redirect()->route('user.index')->with('success','Chỉnh sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success','Xóa thành công');
    }
}
