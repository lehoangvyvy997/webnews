<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\news;
use App\User;
use App\admin;
use Hash;
use App\comment;
use Auth;

class HomeController extends Controller
{
    public function getIndex(){
        $new = DB::table('news')->orderBy('id', 'desc')->take(5)->get();
        return view('home.home',['new' => $new]);
    }

    public function getContent($tit){
    	$id = "";
        $new = DB::table('news')->where('changetitle','=',$tit)->get();
        foreach($new as $val){
            $id = $val->id;
            $n = news::find($id);
            $n['view'] += 1;
            $n->save();
        }
        $cmt = DB::table('comment')->where('new_id','=',$id)->get();
        $user = DB::table('users')->get();
        return view('home.content',['new' => $new , 'cmt' => $cmt , 'user' => $user]);
    }

    public function getAbout(){
        return view('welcome');
    }

    public function getCategory($cate){
        $new = DB::table('news')->where('category','=',$cate)->get();
        return view('home.cate',['new' => $new , 'cate' => $cate]);
    }

    public function getRegis(){
        if(Auth::check()){
            return back();
        }
        return view('home.regis');
    }

    public function getLogin(){
        if(Auth::check()){
            return back();
        }
        return view('home.login');
    }

    public function getLogout(){
        if(!Auth::check()){
            return back();
        }
        Auth::logout();
        return redirect()->route('home.get.index');
    }

    public function getEdit(){
        if(!Auth::check()){
            return back();
        }
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('home.edit',['user' => $user]);
    }

    public function postRegis(Request $request){
        if(Auth::check()){
            return back();
        }

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

        return redirect()->route('home.get.login')->with(['uname' => $request['username'] , 'phanquyen' => 'Tạo tài khoản thành công !']);

    }
    
    public function postLogin(Request $request){
        if(Auth::check()){
            return back();
        }

        $username = $request->username;
		$password = $request->password;

        if(Auth::attempt(['username' => $username , 'password' => $password])){
            return redirect()->route('home.get.index');
        }
        else{
            return back()->with('error','Đăng nhập thất bại !');
        }
        
    }

    public function postComment(Request $request , $new_id){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $cmt = new comment;
            $cmt['user_id'] = $user_id;
            $cmt['new_id'] = $new_id;
            $cmt['content'] = $request['content'];

            $cmt->save();
            return back();
        }
        else{
            return back()->with('phanquyen' , 'Bạn chưa đăng nhập !');
        }
    }

    public function postChangePass(Request $rq){

        if(!empty($rq['oldpass']) && !empty($rq['newpass']) && !empty($rq['renewpass'])){

            $ad = Auth::user();
            $id = $ad['id'];
            $user = User::find($id);
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

        $ad = Auth::user();
        $id = $ad['id'];
        $admin = User::find($id);

        if($request -> hasFile('avatar')){
            $file = $request -> file('avatar');
            $fileType = $file -> getClientOriginalExtension('avatar');
            if($fileType == "jpg" || $fileType == 'png' || $fileType == 'jpeg'){

                $AvatarName = 'avatar_'.$admin['username'].rand().'.'.$fileType;
                $file -> move('admin_layout/images/avatar-user',$AvatarName);
                if(file_exists($admin['avatar'])){
                    unlink($admin['avatar']);
                    $admin['avatar'] = "";
                }
                $urlAvatar = 'admin_layout/images/avatar-user/'.$AvatarName;
                $admin['avatar'] = $urlAvatar;
                
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

        $admin['fullname'] = $fullname;
        $admin['age'] = $age;
        $admin['email'] = $email;
        $admin['facebook'] = $facebook;
        $admin['github'] = $github;
        $admin['skype'] = $skype;
    
        $admin->save();

        return redirect()->route('home.get.index')->with('phanquyen' ,'Cập nhật thông tin thành công !');

    }

}
