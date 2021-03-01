<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NUTRIFMG</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                /*color: #636b6f;*/
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
            a {
                color: inherit;
                text-decoration: none
            }
            p span#cor1 {   color: #195128; background-color: #FFFFFF}p span#cor2 {   color: #FFFFFF; background-color: #195128 }
            .btn {
                color: white;
            }
            .bg-img{
                background-image: url('../public/image/bg-home.png');
                background-repeat: no-repeat;
                background-size: cover;

            }
        </style>
    </head>
    <body >
        <div  class="flex-center position-ref full-height p-3 mb-2  text-dark  bg-img" >
            @if (Route::has('login'))
                <div class="top-right links">

                </div>
            @endif


            <div class="content p-3 mb-2 bg-white">
                <div class="title m-b-md alert border border-dark" role="alert">
                    <img src="{{url('image/logo-new.png')}}" class="img-fluid " alt="Responsive image" style="max-width: 750px">

                </div>
                @if (Route::has('login'))
                <div class="btn btn-success links">
                    @auth
                        <a href="{{ url('/home') }}">Entrar</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-white " role="button">
                            Entrar
                        </a>
                    @endauth
                </div>
            @endif
            </div>
        </div>
    </body>
</html>
