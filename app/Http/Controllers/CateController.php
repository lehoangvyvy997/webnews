<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\cate;

class CateController extends Controller
{
    
    public function getList(){
        $cate = cate::all();
        return view('admin.category.list',['cate' => $cate]);
    }

    public function getCreate(){
        return view('admin.category.create');
    }

    public function getEdit($id){
        $cate = cate::find($id);
        return view('admin.category.edit',['cate' => $cate]);
    }

    public function postCreate(Request $request){

        $this -> validate($request,[
            'cate' => 'required|unique:category,cate',
            'status' => 'required'
        ],[
            'cate.required' => 'Vui lòng nhập category',
            'cate.unique' => 'Category đã tồn tại',
            'status.required' => 'Vui lòng chọn trạng thái'
        ]);

        $cate = $request['cate'];
        $status = $request['status'];

        $category = new cate;

        $category['cate'] = $cate;
        $category['status'] = $status;
        $category -> save();

        return redirect()->route('admin.category.get.list');

    }

    public function postEdit(Request $request , $id){

        $category = cate::find($id);
        if($category['cate'] == $request['cate']){

            $this -> validate($request,[
                'status' => 'required'
            ],[
                'status.required' => 'Vui lòng chọn trạng thái'
            ]);

            $category['cate'] = $request['cate'];
            $category['status'] = $request['status'];

            $category -> save();

            return redirect()->route('admin.category.get.list');

        }

        $this -> validate($request,[
            'cate' => 'required|unique:category,cate',
            'status' => 'required'
        ],[
            'cate.required' => 'Vui lòng nhập category',
            'cate.unique' => 'Category đã tồn tại',
            'status.required' => 'Vui lòng chọn trạng thái'
        ]);

        $cate = $request['cate'];
        $status = $request['status'];

        $category = cate::find($id);

        $category['cate'] = $cate;
        $category['status'] = $status;
        $category -> save();

        return redirect()->route('admin.category.get.list');

    }

    public function getDelete($id){
        DB::table('category')->where('id', '=', $id)->delete();
        return redirect()->route('admin.category.get.list');
    }



}
