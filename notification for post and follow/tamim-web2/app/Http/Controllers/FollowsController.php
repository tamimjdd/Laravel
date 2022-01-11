<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usermid');
    }

    public function store(User $user){
        //$bool= $user->following()->where('profile_id', $user->id)->count();
        $user2 = User::findOrFail(auth()->user()->id);

        $checkUser = User::findOrFail($user->id);


        if(!$user2->isFollowing($user)){
            $follower = auth()->user();
            $user->notify(new UserFollowed($follower));
        }

        return auth()->user()->following()->toggle($user->profile);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
}
