<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usermid');
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $data=request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);

        $newImageName= uniqid(). '-'. $request->title.'.' .
        $request->image->extension();
        //dd($newImageName);
        //$image2= $request->file('image');
        //dd($image2);
        $request->image->move(public_path() . '/images/',$newImageName);
        //dd("yes");
        $image=Image::make(public_path() . '/images/'.$newImageName);
        $image->resize(1200,1200);
        $image->save();

        $slug = SlugService::createSlug(Post::class, 'slug',
        $request->title);
        //dd($slug);
        auth()->user()->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/profile/'.auth()->user()->id);

    }

    public function show(\App\Models\Post $post){
        return view('posts.show', compact('post'));
    }


}
