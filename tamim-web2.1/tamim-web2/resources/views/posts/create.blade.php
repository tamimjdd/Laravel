@extends('layouts.app')

@section('content')

<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            Create Post
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-20">
    <form action="/p" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Title...."
        class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">
        @error('title')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <textarea name="description"
        placeholder="Description..."
        class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl
        outline-none"></textarea>

        @error('title')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        <div clss="bg-gray-lighter pt-15">
            <label class="w-80 flex flex-col items-center px-2 py-3
            bg-white-rounded-lg shadow-lg tracking-wide uppercase border
            border-blue cursor-pointer">
                <span class="mt-2 text-base leading-normal">
                    Select a file
                </span>
                {{-- <input type="file" name="image" class="hidden"> --}}
                <input name= "image" class="block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded-lg" aria-describedby="user_avatar_help" id="user_avatar" type="file">
            </label>

            @error('image')
            <p class="text-red-500 text-xs italic mt-4">
                {{ $message }}
            </p>
            @enderror
        </div>
        <button
            type="submit"
            class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg
            font-extrabold py-4 px-8 rounded-3xl">
            Submit Post
        </button>
    </form>
</div>
@endsection
