<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

global $head,$body,$end;
$head = '<html><head>';
$body = '</head></html>';
$end = '</body></html>';



class MenuController extends Controller
{
    // 以下の記述を追加
    public function menu()
    {
        $html= '<a href="/test/test"> go to other page</a>' ;
        return $html;

    }

    public function test()
    {
        return view('test/test');
    }
    

    public function nayami()
    {
        return view('test/nayami');
    }
}