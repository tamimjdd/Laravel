<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthorizeDevice;
use Stevebauman\Location\Facades\Location;
use App\Models\device_verification;
class UserMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         $ip=\request()->ip();

        $oldip=device_verification::find(Auth::id());


        if($oldip->ip_address != $ip){
            $location= Location::get();
            $rand=rand(0, 99999);

            $flight = device_verification::find(Auth::id());
            $flight->reg_id = $rand;
            $flight->save();

            $authorize = [
                'ip_address' => \Request::ip(),
                'browser' => $request->header('User-Agent'),
                'token' =>$rand,
                'location' =>$location->countryName
            ];

            Mail::to($request->user())
                ->send(new AuthorizeDevice($authorize, $request));
                return response()->view('auth.authorize');
        }


        return $next($request);
    }
}
