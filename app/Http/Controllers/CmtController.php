<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\news;
use App\User;
use App\comment;

class CmtController extends Controller
{
    public function getList(){
        $cmt = DB::table('comment')->get();
        $new = DB::table('news')->get();
        $user = DB::table('users')->get();
        return view('admin.cmt.list',['new' => $new , 'cmt' => $cmt , 'user' => $user]);
    }

    public function getDelete($id){
        DB::table('comment')->where('id', '=', $id)->delete();
        return redirect()->route('admin.cmt.get.list');
    }

    public function getEdit($id){
        $cmt = comment::find($id);
        return view('admin.cmt.edit',['cmt' => $cmt]);
    }

    public function postEdit(Request $request , $id){

        $cmt = comment::find($id);

        $content = $request['content'];
        $user_id = $request['user'];
        $new_id = $request['new'];

        $cmt['content'] = $content;
        $cmt['user_id'] = $user_id;
        $cmt['new_id'] = $new_id;

        $cmt -> save();

        return redirect()->route('admin.cmt.get.list');

    }
}
