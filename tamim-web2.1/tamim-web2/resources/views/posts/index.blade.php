@extends('layouts.app')

@section('content')

<div class="inline-grid grid-cols-3 gap-4">
    @foreach($posts as $post)
        <div class="pt-4">
            <a href="/p/{{$post->id}}">
                <img src="{{ asset('images/' . $post->thumbnail) }}" class="w-4/5">
                <div class="flex pt-4">
                    <img src="{{ asset('images/' . $post->user->profile->image) }}" class="w-6 rounded-full lg:w-14" alt="">

                    <div class="text-sm lg:text-2xl">{{$post->title}}</div >
                </div>
            </a>
        </div>
    @endforeach

</div>


@endsection
