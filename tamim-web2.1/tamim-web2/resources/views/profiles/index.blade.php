@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class="container">
        <div class="lg:flex lg:flex-row md:flex md:flex-row" >
            <div class="p-5 " >

                {{-- <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-100"> --}}
                <img src="{{ $user->profile->profileImage()}}" class="rounded-circle w-44">

            </div>
            <div class="p-5 ">
                <div >
                    <div >
                        <div class="flex justify-between items-baseline">
                            <h1 class="text-4xl bold">{{$user->username}}</h1>
                            <follow-button user-id="{{ $user->id }}" follows={{ $follows }}></follow-button>
                            @can('update',$user->profile)
                                <a href="/p/create" class="ml-4">Add New Post</a>
                            @endcan



                        </div >

                        {{-- <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button> --}}
                    </div>
                    @can('update',$user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                    @endcan

                    {{-- @can('update',$user->profile)
                        <a href="#">Add New Post</a>
                    @endcan --}}

                </div>
                @can('update',$user->profile)
                    {{-- <a href="/profile/{{$user->id}}/edit">Edit Profile</a> --}}
                @endcan
                <div class="d-flex pt-3">
                    <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                    <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <br>
                <div class="pt-4 font-bold">{{$user->profile->title ?? 'nothing'}}</div>
                <div>
                    <h1>{{$user->profile->description ?? 'nothing'}}</h1>

                </div>
                <div><a href="#">{{$user->profile->url ?? 'N/A'}}</a></div>
            </div>
        </div>
        <hr>
        <div class="inline-grid grid-cols-3 gap-4  ">

            @foreach($user->posts as $post)
                <div class="pt-4 relative">
                    <div class="absolute">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit"></i>
                            Edit
                          </button>
                          <button class="bg-red-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                          </button>
                    </div>
                    <a href="/p/{{$post->id}}">
                        <img src="{{ asset('images/' . $post->thumbnail) }}" class="w-4/5">
                        <div class="h4">{{$post->title}}</div >
                    </a>
                </div>
            @endforeach

        </div>

    </div>
</main>
@endsection

