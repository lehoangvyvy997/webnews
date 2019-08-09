<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;

class UserController extends Controller
{
    public function getCreate(){
        return view('admin.user.create');
    }

    public function getList(){
        $user = User::all();
        return view('admin.user.list',['user' => $user]);
    }

    public function getEdit($id){
        $user = User::find($id);
        return view('admin.user.edit',['user' => $user]);
    }

    public function getDelete($id){
        $admin = Auth::guard('admin')->user();
        $adminLv = $admin['level'];
        if($adminLv == 1){
            return back()->with('phanquyen','Bạn không đủ thẩm quyền thực hiện hành động này !');
        }

        $user = User::find($id);
        if(file_exists($user['avatar'])){
            unlink($user['avatar']);
        }
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('admin.user.get.list');
    }

    public function postCreate(Request $request){

        $this -> validate($request , [
            'username' => 'required|min:5|unique:users,username',
            'password' => 'required',
            'repassword' => 'required|same:password'
        ] , [
            'username.required' => 'Vui lòng nhập tên tài khoản !',
            'username.min' => 'Tên tài khoản ít nhất 5 kí tự !',
            'username.unique' => 'Tên tài khoản đã tồn tại !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu !',
            'repassword.same' => 'Mật khẩu nhập lại không khớp !'
        ]);
        
        $user = new User;
        $user['username'] = $request['username'];
        $user['password'] = bcrypt($request['password']);
        $user -> save();

        return redirect()->route('admin.user.get.list');
        
    }

    public function postEdit(Request $request , $id){
    
        $user = User::find($id);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.$user['username'].rand().'.'.$fileType;
                $file -> move('admin_layout/images/avatar-user',$AvatarName);
                if(file_exists($user['avatar'])){
                    unlink($user['avatar']);
                    $user['avatar'] = "";
                }
                $urlAvatar = 'admin_layout/images/avatar-user/'.$AvatarName;
                $user['avatar'] = $urlAvatar;
                
            }
            else{
                return back()->with("error","Phải là file ảnh (jpg , png ,jpeg)");
            }
        }

        $fullname = $request['fullname'];
        $age = $request['age'];
        $email = $request['email'];
        $facebook = $request['facebook'];
        $github = $request['github'];
        $skype = $request['skype'];

        $user['fullname'] = $fullname;
        $user['age'] = $age;
        $user['email'] = $email;
        $user['facebook'] = $facebook;
        $user['github'] = $github;
        $user['skype'] = $skype;
    
        $user -> save();

        return redirect()->route('admin.user.get.list');

    }
}
