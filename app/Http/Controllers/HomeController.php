<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chirp;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*
    public function index()
    {
        return view('home');
    }
    */
    public function index()
    {
        $chirps = Chirp::with('author')
            ->orderBy('posted_at', 'desc')
            ->get();
        return view('home', ['chirps' => $chirps]);
    }

    public function actOnChirp(Request $request, $id)
    {
        $action = $request->get('action');
        switch ($action) {
            case 'Like':
                Chirp::where('id', $id)->increment('likes_count');
                break;
            case 'Unlike':
                Chirp::where('id', $id)->decrement('likes_count');
                break;
        }
        return '';
    }
}
