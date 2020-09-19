<?php

namespace App\Http\Controllers;

use App\Question;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $items = Like::all();
        $items2 = Question::findorFail(2);
        $like = $items2->likes()->first();
        return view('test.nayami2')->with([
            'post'=>$items, 
            'post2'=>$items2,
            'like'=>$like
        ]);
    }
    
}
