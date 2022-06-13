<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset ('img/na3.png') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <title>Kantin IT Del</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("../img/2138.jpg");
                background-size: 1710px 100%;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: auto;
            }

            .full-height1 {
                height: 100vh;
            }

            .flex-center1 {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref1 {
                position: relative;
            }

            .top-right1 {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content1 {
                text-align: center;
                background-color: #13131449;
                padding: 4%;
                border-radius: 20px;
            }

            .title {
                font-size: 84px;
                font-family: 'Nexa free font';
                color: white;
            }

            .title1 {
                font-size: 30px;
                font-family: 'Nexa free font';
                color: white;
            }

            .links1 > b a {
                color: white;
                font-family: 'Nexa free font';
                padding: 0 25px;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center1 position-ref1 full-height1">
            @if (Route::has('login'))
                <div class="top-right1 links1">
                    @auth
                    </div>

                    <div class="content1">
                        <div class="title1 m-b-md">
                            Masak Aktif Berakhir Silahkan login kembali
                        </div>
                        {{-- logout auth --}}
                        <a href="{{ route('logout') }}" class="btn btn-primary has-icon" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>

                    @else
                        <b><a href="{{ route('login') }}">Login</a></b>

                        @if (Route::has('register'))
                            <b><a href="{{ route('register') }}">Register</a></b>
                        @endif

                    </div>

                    <div class="content1">
                        <div class="title m-b-md">
                            Kantin IT Del
                        </div>

                        <div class="links1">
                            <b><a href="https://laravel.com/docs">Facebook</a>
                            <a href="https://instagram.com/it.del?utm_medium=copy_link">Instagram</a>
                        </div>
                    </div>
                    @endauth
            @endif
        </div>
    </body>
</html>
