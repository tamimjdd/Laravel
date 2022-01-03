<html>
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('sass/app.scss') }}" rel="stylesheet">

    <title>How to Use Summernote WYSIWYG Editor with Laravel? - ItSolutionStuff.com</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <style>
        .images-preview-div img
        {
        padding: 10px;
        max-width: 200px;
        }
        .preview-image img
        {
                padding: 10px;
                max-width: 100px;
        }


        h2{
        text-align: center;
        font-size:22px;
        margin-bottom:50px;
    }
    body{
        background:#f2f2f2;
    }
    .section{
        margin-top:150px;
        padding:50px;
        background:#fff;
    }
    .hidden-cls{
        visibility: hidden;
    }

        </style>



</head>
<body>

    <header class="bg-blue-900 py-6">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div>
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                    AnyBlog
                </a>
            </div>
            <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                @guest
                    <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="/profile/{{ Auth::user()->id }}">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </nav>
        </div>
    </header>
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

            {{-- <textarea name="description" id="texteditor"
            placeholder="Description..."
            class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl
            outline-none"></textarea> --}}

                                <label><strong>Description :</strong></label>
                                <div>
                                    <div>Slecet your editor to add description: (Write in only one editor)</div>
                                    Summeronpte Editor:
                                    <input class="coupon_question" id="one" type="checkbox" name="coupon_question" value="1" onchange="valueChanged()"/>
                                    Froala Editor:
                                    <input class="coupon_question" id="two" type="checkbox" name="coupon_question" value="1" onchange="valueChanged2()"/>
                                </div>
                                <div style="display:none" class="answer">
                                    <textarea class="summernote "  name="description"></textarea>
                                </div>
                                <div class="answer2" style="display:none">
                                    <textarea id="forala"  name="description2"></textarea>
                                </div>
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
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('.summernote').summernote();
        });
        function valueChanged()
        {
            if($('#one').is(":checked")){
                $(".answer").show();
                $(".answer2").hide();
            }
        }
        function valueChanged2()
        {
            if($('#two').is(":checked")){

                $(".answer2").show();
                $(".answer").hide();
            }
        }
        $('input.coupon_question').on('change', function() {
            $('input.coupon_question').not(this).prop('checked', false);
        });
        new FroalaEditor('#forala');
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


</body>
</html>
