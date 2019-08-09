<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\admin;

class AdminController extends Controller
{
    
    public function getLogin(){
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.get.index');
        }
        return view('admin.other.login');
    }

    public function getIndex(){
        $admin = DB::table('admin')->count();
        $user = DB::table('users')->count();
        $cate = DB::table('category')->count();
        $new = DB::table('news')->count();
        $cmt = DB::table('comment')->count();
        $news = DB::table('news')->get();
        $sum = 0;
        foreach($news as $val){
            $sum += $val->view;
        }
        return view('admin.other.index',['admin' => $admin ,'user' => $user , 'cate' => $cate ,'new' => $new ,'cmt' => $cmt, 'sum' => $sum]);
    }

    public function getLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.get.login');
    }

    public function getListAdmin(){
        $check = admin::all();
        return view('admin.admin-profile.list',compact('check'));
    }

    public function getProfile(){
        $ad = Auth::guard('admin')->user();
        $id = $ad['id'];
        $admin = admin::find($id);
        $check = admin::all();
        $count = DB::table('news')->where('author2','=',$admin['username'])->count();
        $news = DB::table('news')->where('author2','=',$admin['username'])->get();
        return view('admin.admin-profile.info',['admin' => $admin , 'count' => $count , 'news' => $news ],compact('check'));
    }

    public function getEdit(){
        $ad = Auth::guard('admin')->user();
        $id = $ad['id'];
        $admin = admin::find($id);
        return view('admin.admin-profile.edit',['admin' => $admin]);
    }

    public function getAdminInfo($id){
        $admin = admin::find($id);
        $count = DB::table('news')->where('author2','=',$admin['username'])->count();
        $check = admin::all();
        $news = DB::table('news')->where('author2','=',$admin['username'])->get();
        return view('admin.admin-profile.adinfo',['admin' => $admin , 'count' => $count , 'news' => $news ],compact('check'));
    }

    public function getEditAdminInfo($id){
        $admin = admin::find($id);
        return view('admin.admin-profile.editadinfo',['admin' => $admin]);
    }

    public function getCreate(){
        return view('admin.admin-profile.create');
    }

    public function postLogin(Request $request){

        $username = $request->username;
		$password = $request->password;
        $remember = $request->remember ? $request->remember : 0;

        if(Auth::guard('admin')->attempt(['username' => $username , 'password' => $password] , $remember)){
            if($remember === 'on'){
                setcookie($username,rand(), time() + 10, '/', '127.0.0.1');
            }
            return redirect()->route('admin.get.index');
        }
        else{
            return back()->with('error','Đăng nhập thất bại !');
        }
        
    }

    public function postChangePass(Request $rq){

        if(!empty($rq['oldpass']) && !empty($rq['newpass']) && !empty($rq['renewpass'])){

            $ad = Auth::guard('admin')->user();
            $id = $ad['id'];
            $user = admin::find($id);
            $password = $user -> password;
            $oldpass = $rq-> oldpass;
            hash::check($oldpass,$password);
            if(!hash::check($oldpass,$password)){
                echo 'Mật khẩu cũ không chính xác !';
            }
            if($rq -> newpass != $rq -> renewpass){
                echo 'Mật khẩu nhập lại không khớp !';
            }
            else{
                $user -> password = bcrypt($rq -> newpass);
            
                $user -> save();
                echo 'Đổi mật khẩu thành công !';
            }

        }
        else{
            echo 'Vui lòng nhập đầy đủ thông tin !';
        }
        
    }

    public function postEdit(Request $request){

        $ad = Auth::guard('admin')->user();
        $id = $ad['id'];
        $admin = admin::find($id);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.$admin['username'].rand().'.'.$fileType;
                $file -> move('admin_layout/images/avatar-admin',$AvatarName);
                if(file_exists($admin['avatar'])){
                    unlink($admin['avatar']);
                    $admin['avatar'] = "";
                }
                $urlAvatar = 'admin_layout/images/avatar-admin/'.$AvatarName;
                $admin['avatar'] = $urlAvatar;
                
            }
            else{
                return back()->with("error","Phải là file ảnh (jpg , png ,jpeg)");
            }
        }

        $fullname = $request['fullname'];
        $age = $request['age'];
        $position = $request['position'];
        $email = $request['email'];
        $facebook = $request['facebook'];
        $github = $request['github'];
        $skype = $request['skype'];
        $status = $request['status'];

        $admin['fullname'] = $fullname;
        $admin['age'] = $age;
        $admin['position'] = $position;
        $admin['email'] = $email;
        $admin['facebook'] = $facebook;
        $admin['github'] = $github;
        $admin['skype'] = $skype;
        $admin['status'] = $status;
    
        $admin -> save();

        return redirect()->route('admin.info.get.profile');

    }

    public function postEditAdminInfo(Request $request , $id){
    
        $admin = admin::find($id);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.$admin['username'].rand().'.'.$fileType;
                $file -> move('admin_layout/images/avatar-admin',$AvatarName);
                if(file_exists($admin['avatar'])){
                    unlink($admin['avatar']);
                    $admin['avatar'] = "";
                }
                $urlAvatar = 'admin_layout/images/avatar-admin/'.$AvatarName;
                $admin['avatar'] = $urlAvatar;
                
            }
            else{
                return back()->with("error","Phải là file ảnh (jpg , png ,jpeg)");
            }
        }

        $fullname = $request['fullname'];
        $age = $request['age'];
        $position = $request['position'];
        $email = $request['email'];
        $facebook = $request['facebook'];
        $github = $request['github'];
        $skype = $request['skype'];
        $status = $request['status'];

        $admin['fullname'] = $fullname;
        $admin['age'] = $age;
        $admin['position'] = $position;
        $admin['email'] = $email;
        $admin['facebook'] = $facebook;
        $admin['github'] = $github;
        $admin['skype'] = $skype;
        $admin['status'] = $status;
    
        $admin -> save();

        return redirect()->route('admin.info.get.admininfo' , $id);

    }

    public function postCreate(Request $request){

        $this -> validate($request , [
            'username' => 'required|min:5|unique:admin,username',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'level' => 'required'
        ] , [
            'username.required' => 'Vui lòng nhập tên tài khoản admin !',
            'username.min' => 'Tên tài khoản admin ít nhất 5 kí tự !',
            'username.unique' => 'Tên tài khoản admin đã tồn tại !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu !',
            'repassword.same' => 'Mật khẩu nhập lại không khớp !',
            'level.required' => 'Vui lòng chọn level !'
        ]);
        
        $admin = new admin;
        $admin['username'] = $request['username'];
        $admin['password'] = bcrypt($request['password']);
        $admin['level'] = $request['level'];
        $admin -> save();

        return redirect()->route('admin.info.get.listadmin');
        
    }

}
