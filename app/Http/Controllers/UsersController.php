<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Person;
use Illuminate\Support\Facades\Auth;
use App\Post;

class UsersController extends Controller
{

    public function nayami(Request $request)
    {
        $items = DB::table('Question')->get();
        return view('test.nayami',['items'=>$items]);
    }

    public function nayami_detail(Request $request)
    {
        $item = DB::table('Question')->get();
        return view('test.nayami_detail',['item'=>$item]);
    }


    public function nayami_add(Request $request)
    {
        return view('test.add');
    }

    public function show_user(Request $request)
    {
        $id = Auth::id();
        $items = DB::table('users')->where('id',$id)->first();
        return view('layouts.layout',['items'=>$items]);
    }




    public function nayami_create(Request $request)
    {
        $param = [
            'questionID' => $request->questionID,
            'title' => $request->title,
            'date' => $request->date,
            'userID' => $request->userID,
            'main' => $request->main,
        ];
        DB::table('Question') ->insert($param);
        return redirect('/test');
    }

    



    public function ses_get(Request $request)
    {
        $sesdata = $request->session()->get('id');
        return view('layouts.layout', ['session_data' => $sesdata]);
    }

    public function ses_put(Request $request)
    {
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }



    
}
