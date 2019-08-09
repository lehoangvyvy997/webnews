<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function ajaxRequest()
    {
        return view('demo.ajaxRequest');
    }

    public function ajaxRequestPost1(Request $request)
    {
        $input = $request->all();
        $message = '';
        $r1 = $request['name'];
        $r2 = $request['email'];

        $message .= $r1;
        $message .= $r2;


        return response()->json(['success'=>$message]);
    }
    public function ajaxRequestPost2(Request $request)
    {
        $input = $request->all();
        $message = '';
        $r1 = $request['name'];

        $message .= $r1;


        return response()->json(['success'=>$message]);
    }
}
