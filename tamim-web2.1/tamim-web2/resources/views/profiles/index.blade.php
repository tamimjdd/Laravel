@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class="container">
        <div class="inline-grid grid-cols-3 gap-4">
            <div class="p-5">
                this is picture
                {{-- <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-100"> --}}
            </div>
            <div class="pt-5">
                <div class="flex-initial justify-between items-baseline">
                    <div class="flex-initial items-center pb-3">
                        <div class="h4">{{$user->username}}

                        </div >
                        <a href="/p/create">Add New Post</a>
                        {{-- <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button> --}}
                    </div>
                    {{-- @can('update',$user->profile)
                        <a href="#">Add New Post</a>
                    @endcan --}}

                </div>
                @can('update',$user->profile)
                    {{-- <a href="/profile/{{$user->id}}/edit">Edit Profile</a> --}}
                @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-5"><strong>12k</strong> followers</div>
                    <div class="pr-5"><strong>11k</strong> following</div>
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
        <div class="inline-grid grid-cols-3 gap-4">
            @foreach($user->posts as $post)
                <div class="pt-4">
                    <a href="/p/{{$post->id}}">
                        <img src="{{ asset('images/' . $post->image_path) }}" class="w-4/5">
                        <div class="h4">{{$post->title}}</div >
                    </a>
                </div>
            @endforeach

        </div>

    </div>
</main>
@endsection
