<?php

namespace App\Http\Controllers;

use App\Models\device_verification;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

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

        $oldip=DB::select("SELECT * FROM device_verifications ORDER BY id DESC LIMIT 1");
        $var=null;
        foreach ($oldip as $user) {
            $var= $user->ip_address;
        }

        if($var == $ip){
            return view('home');
        }
        else{
            //abort(404);
        }
    }
}
