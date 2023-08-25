<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        dd(auth()->user()->role_id);
        if(auth()->check() && auth()->user()->role_id == 1){
            dd('admin');
            return redirect()->route('admin.home');
        } else if(auth()->check() && auth()->user()->role_id == 2){
            return redirect()->route('frontend.dashboard');
        }
        return view('home');
    }
}
