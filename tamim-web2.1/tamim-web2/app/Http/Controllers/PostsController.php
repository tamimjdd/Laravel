<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;
use App\Models\Photo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('usermid');
    }


    public function index(){
        $users= auth()->user()->following()->pluck('profiles.user_id');

        $posts= Post::whereIn('user_id', $users)->latest()->get();



        return view('posts.index', compact('posts'));
    }

    public static  function allphoto($post){
        $photo = DB::table('photos')->where('post_id', $post->id)->get();
        return $photo;
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $data=request()->validate([
            'title' => 'required',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg|max:5048',
            'thumbnail' => 'required|mimes:jpg,png,jpeg,gif,svg|max:5048'
        ]);

         $newImageName= uniqid(). '-'. $request->title.'.' .
         $request->thumbnail->extension();

         $request->thumbnail->move(public_path() . '/images/',$newImageName);

         $image=Image::make(public_path() . '/images/'.$newImageName);
         $image->resize(1200,1200);
         $image->save();

        $slug = SlugService::createSlug(Post::class, 'slug',
        $request->title);

        $forid=auth()->user()->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'user_id' => auth()->user()->id,
            'thumbnail' =>$newImageName
        ]);
        $Id = $forid->id;
        //dd($request->file('images'));
        if ($files = $request->file('images')) {

                 foreach($files as $img) {
                    $newImageName= uniqid(). '-'. $request->title.'.' .$img->extension();
                    // Upload Orginal Image
                    $img->move(public_path() . '/images/', $newImageName);
                    $image=Image::make(public_path() . '/images/'.$newImageName);
                    $image->resize(1200,1200);
                    $image->save();
                    // Save In Database
                    $imagemodel= new Photo();
                    $imagemodel->photo_name="$newImageName";
                    $imagemodel->post_id= $Id;
                    $imagemodel->save();
                }

        }

        return redirect('/profile/'.auth()->user()->id);

    }

    public function show(\App\Models\Post $post){

        $photo = DB::table('photos')->where('post_id', $post->id)->get();
        //dd($photo);
        // foreach ($photo as $user) {
        //     echo $user->photo_name;
        // }
        return view('posts.show',[
            'post' => $post,
            'photo' => $photo,
        ]);
    }


}
