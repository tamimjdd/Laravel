<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user){
        $user= User::findOrFail($user);

        return view('profiles.index',[
            'user' => $user,
        ]);
    }

    public function edit(\App\Models\User $user){
        return view('profiles.edit',[
            'user' => $user
        ]);
    }

    public function update(User $user){
        $data= request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
        //dd($data);
        $user->profile->update($data);
        return redirect("/profile/{$user->id}");
    }
}
