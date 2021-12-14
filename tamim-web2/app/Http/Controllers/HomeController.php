<?php

namespace App\Http\Controllers;

use App\Models\device_verification;
use Illuminate\Http\Request;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ip=\request()->ip();
        $oldip=device_verification::find(Auth::id());
        if($oldip->ip_address == $ip){
            return view('home');
        }
        else{
            //abort(404);
        }
    }
}
