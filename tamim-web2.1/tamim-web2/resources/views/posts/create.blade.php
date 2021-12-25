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
    <form name="images-upload-form" action="/p" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
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

        @error('description')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror

        {{-- <div clss="bg-gray-lighter pt-15">
            <label class="lg:w-50 sm:w-50  flex flex-col items-center px-2 py-3
            bg-white-rounded-lg shadow-lg tracking-wide uppercase border
            border-blue cursor-pointer">
                <span class="mt-2 text-base leading-normal">
                    Select a file
                </span>

                <input name= "image" class="block w-full  cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded-lg" aria-describedby="user_avatar_help" id="user_avatar" type="file" multiple>
            </label>
            <div class="col-md-12">
                <div class="mt-1 text-center">
                    <div class="preview-image"> </div>
                </div>
            </div>
            @error('image')
            <p class="text-red-500 text-xs italic mt-4">
                {{ $message }}
            </p>
            @enderror
        </div> --}}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="lg:w-50 sm:w-50  flex flex-col items-center px-2 py-3
                        bg-white-rounded-lg shadow-lg tracking-wide uppercase border
                        border-blue cursor-pointer">
                        <span class="mt-2 text-base leading-normal">
                            Select One or Multiple Images
                        </span>
                        <input type="file" name="images[]" id="images" placeholder="Choose images" multiple="multiple" >
                </div>
                @error('images')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <div class="mt-1 text-center">
                    <div class="row images-preview-div preview-image" id="image2"> </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="lg:w-50 sm:w-50  flex flex-col items-center px-2 py-3
                    bg-white-rounded-lg shadow-lg tracking-wide uppercase border
                    border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Select Thumbnail for Post
                    </span>
                    <input type="file" name="thumbnail" id="thumbnail" placeholder="Choose thumbnail">
            </div>
            @error('thumbnail')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(function() {
    // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {

                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }


        };
        function removeAllChildNodes(parent) {
            while (parent.firstChild) {
                parent.removeChild(parent.firstChild);
            }
        }

        $('#images').on('change', function() {
            var remove= document.getElementById("image2");
            removeAllChildNodes(remove);

            multiImgPreview(this, 'div.images-preview-div');
        });



    });
</script>

@endsection
