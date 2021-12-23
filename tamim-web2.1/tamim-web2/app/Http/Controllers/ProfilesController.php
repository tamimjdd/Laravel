<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;

class ProfilesController extends Controller
{
    public function index($user){
        $user= User::findOrFail($user);

        return view('profiles.index',[
            'user' => $user,
        ]);
    }

    public function edit(\App\Models\User $user){
        $this->authorize('update',$user->profile);

        return view('profiles.edit',[
            'user' => $user
        ]);
    }

    public function update(User $user){
        $this->authorize('update',$user->profile);


        $data= request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);




        if(request('image')){
            $slug = SlugService::createSlug(Post::class, 'slug',
            request('title'));
            $newImageName= uniqid(). '-'. $slug.'.' .
            request('image')->extension();
            request('image')->move(public_path() . '/images/',$newImageName);
            $image=Image::make(public_path() . '/images/'.$newImageName);
            $image->resize(1200,1200);
            $image->save();
        }


        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $newImageName]
        ));

        return redirect("/profile/{$user->id}");
    }
}
