<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            img{
                max-width:180px;
            }

            input[type=file]{
                padding:10px;
                background:#2d2d2d;
            }

        </style>
        <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/toastr.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{asset('frontend/js/toastr.min.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <form id="cover_img_form" method="post" enctype="enctype="multipart/form-data"">
                    <input type='file' name="edit_cover_image" class="form-control inpt_cov"/>
                </form>
                <img id="cover_id" src="http://placehold.it/180" alt="your image" />

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
<script>
  @if(Session::has('success'))
        $(function () {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": true,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success("{{ Session::get('success') }}");
        })
    @endif

    @if(Session::has('error'))
        $(function () {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": true,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.error("{{ Session::get('error') }}");
        })
    @endif
</script>
<script type="text/javascript">
    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('#blah')
    //                 .attr('src', e.target.result);
    //         };

    //         reader.readAsDataURL(input.files[0]);

    //         var da=new FormData($("#cover_img_form")[0]);
    //     $.ajax({
    //         url:'{{ url('/')}}',
    //         type:'POST',
    //         data:da,
    //         processData: false,
    //         contentType: false,
    //         success:function(resp) {
    //             if (resp.status == 'success') {
    //                 var url = "{{asset('public/frontend/imgs/brandCoverImage')}}";
                    
    //                 if (resp.fileName) {
    //                     var img_url = url + '/' + resp.fileName;
    //                     $('.cover_img').attr('src',img_url);
    //                 }  
    //                 alert('Cover image uploaded successfully');
    //                 // toastr.success('Cover image uploaded successfully');                    
    //             }else{
    //                 alert('Something went wrong, please try again');
    //                 // toastr.success('Something went wrong, please try again');
    //             }                
    //         }
    //     }); 
    //     }
    // }
    $('input[name="edit_cover_image"]').on('change', function () {
        var input = this;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('cover_id');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
        console.log('here')
        var da=new FormData($("#cover_img_form")[0]);
        $.ajax({
            url:'{{ url('/uploadImage')}}',
            type:'POST',
            data:da,
            processData: false,
            contentType: false,
            success:function(resp) {
                if (resp.status == 'success') {
                    var url = "{{asset('public/frontend/imgs/brandCoverImage')}}";
                    
                    if (resp.fileName) {
                        var img_url = url + '/' + resp.fileName;
                        $('.cover_img').attr('src',img_url);
                    }   
                    console.log('yes')
                    // toastr.success('Cover image uploaded successfully');                    
                }else{
                    console.log('no')
                    // toastr.success('Something went wrong, please try again');
                }                
            }
        }); 
    });
</script>
</html>
